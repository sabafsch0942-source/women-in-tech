<?php
require_once __DIR__.'/../includes/bootstrap.php';

$pdo->exec("
    CREATE TABLE IF NOT EXISTS community_comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT NOT NULL,
        user_id INT NOT NULL,
        body TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_post_created (post_id, created_at),
        FOREIGN KEY (post_id) REFERENCES community_posts(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
");

try {
    $pdo->exec("ALTER TABLE community_posts ADD COLUMN course_id INT NULL AFTER user_id");
} catch (PDOException $e) {
    // Column already exists on upgraded databases.
}
try {
    $pdo->exec("ALTER TABLE community_posts ADD INDEX idx_community_course (course_id)");
} catch (PDOException $e) {
    // Index already exists.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isLoggedIn()) {
    $action = $_POST['action'] ?? '';

    if ($action === 'create_post') {
        $title = trim($_POST['title'] ?? '');
        $body = trim($_POST['body'] ?? '');
        $courseId = (int)($_POST['course_id'] ?? 0);

        if ($title !== '' && $body !== '') {
            if ($courseId > 0) {
                $check = $pdo->prepare("SELECT id FROM courses WHERE id = ? AND status = 'published' LIMIT 1");
                $check->execute([$courseId]);
                $courseId = $check->fetchColumn() ? $courseId : null;
            } else {
                $courseId = null;
            }

            $stmt = $pdo->prepare("INSERT INTO community_posts(user_id, course_id, title, body) VALUES(?,?,?,?)");
            $stmt->execute([$_SESSION['user_id'], $courseId, $title, $body]);
        }
        redirect('index.php?lang=' . urlencode($lang));
    }

    if ($action === 'add_comment') {
        $postId = (int)($_POST['post_id'] ?? 0);
        $body = trim($_POST['comment'] ?? '');

        if ($postId > 0 && $body !== '') {
            $check = $pdo->prepare("SELECT id FROM community_posts WHERE id = ? LIMIT 1");
            $check->execute([$postId]);
            if ($check->fetchColumn()) {
                $stmt = $pdo->prepare("INSERT INTO community_comments(post_id, user_id, body) VALUES(?,?,?)");
                $stmt->execute([$postId, $_SESSION['user_id'], $body]);
            }
        }
        redirect('index.php?lang=' . urlencode($lang) . '#post-' . $postId);
    }
}

$courseTitleColumn = localizedColumn('title');
$courses = $pdo->query("SELECT id, {$courseTitleColumn} AS title FROM courses WHERE status='published' ORDER BY created_at DESC, id DESC")->fetchAll();

$posts = $pdo->query("
    SELECT p.*, u.name, c.id AS course_id, c.{$courseTitleColumn} AS course_title,
           (SELECT COUNT(*) FROM community_comments cc WHERE cc.post_id = p.id) AS comments_count
    FROM community_posts p
    JOIN users u ON u.id = p.user_id
    LEFT JOIN courses c ON c.id = p.course_id
    ORDER BY p.created_at DESC, p.id DESC
")->fetchAll();

$commentsByPost = [];
if ($posts) {
    $ids = array_map(fn($p) => (int)$p['id'], $posts);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("
        SELECT cc.*, u.name
        FROM community_comments cc
        JOIN users u ON u.id = cc.user_id
        WHERE cc.post_id IN ($placeholders)
        ORDER BY cc.created_at ASC, cc.id ASC
    ");
    $stmt->execute($ids);
    foreach ($stmt->fetchAll() as $comment) {
        $commentsByPost[(int)$comment['post_id']][] = $comment;
    }
}

$pageTitle = t('community');
require __DIR__.'/../includes/header.php';
?>

<section class="section community-page">
  <div class="container">
    <div class="section-head">
      <div>
        <span class="eyebrow">Community</span>
        <h1><?= e(t('community_title')) ?></h1>
        <p class="muted"><?= e(t('community_intro')) ?></p>
      </div>
    </div>

    <?php if (isLoggedIn()): ?>
      <form method="post" class="card community-composer" style="margin-bottom:22px">
        <input type="hidden" name="action" value="create_post">
        <h3><?= e(t('new_post')) ?></h3>
        <p class="muted"><?= e(t('community_post_hint')) ?></p>

        <div class="field">
          <label><?= e(t('post_title')) ?></label>
          <input name="title" maxlength="255" required placeholder="<?= e(t('post_title_placeholder')) ?>">
        </div>

        <div class="field">
          <label><?= e(t('course_optional')) ?></label>
          <select name="course_id">
            <option value="0"><?= e(t('general_discussion')) ?></option>
            <?php foreach ($courses as $course): ?>
              <option value="<?= (int)$course['id'] ?>"><?= e($course['title']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label><?= e(t('post_content')) ?></label>
          <textarea name="body" rows="5" maxlength="5000" required placeholder="<?= e(t('post_content_placeholder')) ?>"></textarea>
        </div>

        <button class="btn" type="submit"><?= e(t('publish_post')) ?></button>
      </form>
    <?php else: ?>
      <div class="card community-login-note" style="margin-bottom:22px">
        <strong><?= e(t('community_login_title')) ?></strong>
        <p class="muted"><?= e(t('community_login_text')) ?></p>
        <a class="btn small" href="/women_in_tech_php/auth/login.php?lang=<?= e($lang) ?>"><?= e(t('login')) ?></a>
      </div>
    <?php endif; ?>

    <?php if (!$posts): ?>
      <div class="card empty-state">
        <h3><?= e(t('no_posts')) ?></h3>
        <p class="muted"><?= e(t('no_posts_desc')) ?></p>
      </div>
    <?php endif; ?>

    <div class="community-feed">
      <?php foreach ($posts as $post): ?>
        <article class="card community-post" id="post-<?= (int)$post['id'] ?>">
          <div class="post-header">
            <div class="avatar"><?= e(strtoupper(substr($post['name'], 0, 1))) ?></div>
            <div class="post-author">
              <strong><?= e($post['name']) ?></strong>
              <small class="muted"><?= e($post['created_at']) ?></small>
            </div>
          </div>

          <?php if (!empty($post['course_title'])): ?>
            <div class="community-course-tag">📚 <?= e($post['course_title']) ?></div>
          <?php endif; ?>

          <h3><?= e($post['title']) ?></h3>
          <div class="post-body"><?= nl2br(e($post['body'])) ?></div>

          <div class="comments-heading">
            <strong><?= e(t('comments')) ?></strong>
            <span class="pill"><?= (int)$post['comments_count'] ?></span>
          </div>

          <div class="comments-list">
            <?php foreach (($commentsByPost[(int)$post['id']] ?? []) as $comment): ?>
              <div class="community-comment">
                <div class="avatar small-avatar"><?= e(strtoupper(substr($comment['name'], 0, 1))) ?></div>
                <div>
                  <strong><?= e($comment['name']) ?></strong>
                  <div><?= nl2br(e($comment['body'])) ?></div>
                  <small class="muted"><?= e($comment['created_at']) ?></small>
                </div>
              </div>
            <?php endforeach; ?>

            <?php if (empty($commentsByPost[(int)$post['id']])): ?>
              <p class="muted no-comments"><?= e(t('no_comments')) ?></p>
            <?php endif; ?>
          </div>

          <?php if (isLoggedIn()): ?>
            <form method="post" class="comment-form">
              <input type="hidden" name="action" value="add_comment">
              <input type="hidden" name="post_id" value="<?= (int)$post['id'] ?>">
              <input name="comment" maxlength="2000" required placeholder="<?= e(t('write_comment')) ?>">
              <button class="btn small" type="submit"><?= e(t('send')) ?></button>
            </form>
          <?php else: ?>
            <p class="muted comment-login"><?= e(t('login_to_comment')) ?></p>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__.'/../includes/footer.php'; ?>
