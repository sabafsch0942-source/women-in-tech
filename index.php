<?php
require_once __DIR__.'/includes/bootstrap.php';
$pageTitle='WomenInTech';
$courseCount=(int)$pdo->query("SELECT COUNT(*) FROM courses WHERE status='published'")->fetchColumn();
$studentCount=(int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='student'")->fetchColumn();
$teacherCount=(int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='teacher'")->fetchColumn();
$featured=$pdo->query("SELECT * FROM courses WHERE status='published' ORDER BY id DESC LIMIT 6")->fetchAll();
foreach($featured as &$c) $c=localizedCourse($c); unset($c);
require __DIR__.'/includes/header.php';
?>
<section class="hero"><div class="container hero-grid">
<div><span class="eyebrow">Women • Technology • Community</span><h1><?= t('hero_title') ?></h1><p><?= t('hero_text') ?></p>
<div class="hero-actions"><a class="btn" href="/women_in_tech_php/courses/index.php?lang=<?=e($lang)?>"><?=t('explore_courses')?></a><a class="btn secondary" href="/women_in_tech_php/auth/register.php?lang=<?=e($lang)?>"><?=t('join_now')?></a></div></div>
<div class="hero-art"><div class="hero-orb"></div><div class="hero-card one">💻<strong> <?=t('learn_build_lead')?></strong><p><?=t('practical_education')?></p></div><div class="hero-card two">🎓 <strong><?=t('learning_progress')?></strong><div class="progressbar"><span style="width:72%"></span></div><small>72% <?=t('completed')?></small></div></div>
</div></section>
<div class="container stats">
<div class="stat"><strong><?=number_format($studentCount)?></strong><?=t('students')?></div><div class="stat"><strong><?=number_format($teacherCount)?></strong><?=t('teachers')?></div><div class="stat"><strong><?=number_format($courseCount)?></strong><?=t('courses_count')?></div><div class="stat"><strong>4</strong><?=t('language')?></div>
</div>
<section class="section"><div class="container"><div class="section-head"><div><h2><?=t('courses')?></h2><p class="muted"><?=t('explore_courses')?></p></div><a class="btn secondary" href="/women_in_tech_php/courses/index.php?lang=<?=e($lang)?>"><?=t('learn_more')?></a></div>
<div class="grid"><?php foreach($featured as $c): ?><article class="card course-card"><div class="course-cover"><?=e($c[localizedColumn('title')])?></div><div class="course-meta"><span><?=e($c['level'])?></span><span class="pill"><?= $c['type']==='free'?t('free'):($c['type']==='mixed'?t('mixed'):t('paid')) ?></span></div><h3><?=e($c[localizedColumn('title')])?></h3><p class="muted"><?=e($c[localizedColumn('description')])?></p><div><span class="price"><?=$c['price_iqd']>0?number_format((int)$c['price_iqd']).' '.t('iqd'):t('free')?></span></div><br><a class="btn" href="/women_in_tech_php/courses/details.php?id=<?=$c['id']?>&lang=<?=e($lang)?>"><?=t('learn_more')?></a></article><?php endforeach; ?></div></div></section>
<section class="section"><div class="container"><div class="section-head"><div><h2><?=t('community_title')?></h2><p class="muted"><?=t('learn_together')?></p></div></div><div class="feature-grid"><div class="feature"><div class="feature-icon">🎓</div><h3><?=t('courses')?></h3><p class="muted"><?=t('free_mixed_premium')?></p></div><div class="feature"><div class="feature-icon">💬</div><h3><?=t('ask_teacher')?></h3><p class="muted"><?=t('course_conversations')?></p></div><div class="feature"><div class="feature-icon">⭐</div><h3><?=t('reviews')?></h3><p class="muted"><?=t('learner_feedback')?></p></div></div></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>