<?php
require_once __DIR__.'/../includes/bootstrap.php';requireLogin();
if(($_SESSION['user']['role']??'')!=='admin'){http_response_code(403);die(t('admin_only'));}
$users=(int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();$courses=(int)$pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();$payments=(int)$pdo->query("SELECT COUNT(*) FROM payments WHERE status='pending'")->fetchColumn();
$pageTitle=t('admin');require __DIR__.'/../includes/header.php';?>
<section class="section"><div class="container"><h1><?=t('admin')?></h1><div class="stats" style="margin:20px 0"><div class="stat"><strong><?=$users?></strong><?=t('users') ?></div><div class="stat"><strong><?=$courses?></strong><?=t('courses') ?></div><div class="stat"><strong><?=$payments?></strong><?=t('pending_payments') ?></div><div class="stat"><strong>4</strong><?=t('languages') ?></div></div><div class="card"><h2><?=t('admin_notes')?></h2><p class="muted"><?=t('admin_notes_text')?></p></div></div></section>
<?php require __DIR__.'/../includes/footer.php'; ?>