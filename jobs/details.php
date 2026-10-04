<?php
require_once __DIR__.'/../includes/bootstrap.php';
$id=(int)($_GET['id']??0); $st=$pdo->prepare('SELECT * FROM jobs WHERE id=?'); $st->execute([$id]); $job=$st->fetch(); if(!$job) die(t('job_not_found'));
$job=localizedJob($job); $pageTitle=$job['title']; require __DIR__.'/../includes/header.php'; ?>
<section class="section"><div class="container" style="max-width:850px"><div class="card"><span class="pill"><?=e($job['job_type'])?></span><h1><?=e($job['title'])?></h1><p><strong><?=e($job['company'])?></strong> · <?=e($job['location'])?></p><h3><?=t('job_description')?></h3><p><?=nl2br(e($job['description']))?></p><h3><?=t('requirements')?></h3><p><?=nl2br(e($job['requirements']))?></p><a class="btn" href="apply.php?job_id=<?=$job['id']?>&lang=<?=e($lang)?>"><?=t('apply')?></a></div></div></section>
<?php require __DIR__.'/../includes/footer.php'; ?>