<?php
require_once __DIR__.'/../includes/bootstrap.php';
$jobs=$pdo->query("SELECT * FROM jobs ORDER BY created_at DESC")->fetchAll();
$pageTitle=t('jobs'); require __DIR__.'/../includes/header.php'; ?>
<section class="section"><div class="container">
<div class="section-head"><div><h1><?=t('jobs')?></h1><p class="muted"><?=t('job_intro')?></p></div><div><a class="btn" href="career_match.php?lang=<?=e($lang)?>"><?=t('career_match')?></a> <a class="btn secondary" href="apply.php?lang=<?=e($lang)?>"><?=t('submit_cv')?></a></div></div>
<div class="grid">
<?php foreach($jobs as $job): $job=localizedJob($job); ?><article class="card"><span class="pill"><?=e($job['job_type'])?></span><h2><?=e($job['title'])?></h2><p><strong><?=e($job['company'])?></strong> · <?=e($job['location'])?></p><p class="muted"><?=e($job['description'])?></p><h4><?=t('requirements')?></h4><p class="muted"><?=e($job['requirements'])?></p><a class="btn" href="details.php?id=<?=$job['id']?>&lang=<?=e($lang)?>"><?=t('job_details')?></a></article><?php endforeach; ?>
</div>
</div></section>
<?php require __DIR__.'/../includes/footer.php'; ?>