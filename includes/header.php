<?php require_once __DIR__.'/bootstrap.php'; ?>
<!doctype html>
<html lang="<?= e($lang) ?>" dir="<?= $lang === 'en' ? 'ltr' : 'rtl' ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle ?? 'Women in Tech') ?></title>
<link rel="stylesheet" href="/women_in_tech_php/assets/css/style.css?v=20261003-courses-fix">
</head>
<body>
<header class="site-header">
  <div class="container nav">
    <a class="brand" href="/women_in_tech_php/index.php?lang=<?= e($lang) ?>">
      <span class="brand-mark">W</span><span>Women<span class="brand-accent">InTech</span></span>
    </a>
    <nav>
      <a href="/women_in_tech_php/index.php?lang=<?= e($lang) ?>"><?= t('home') ?></a>
      <a href="/women_in_tech_php/courses/index.php?lang=<?= e($lang) ?>"><?= t('courses') ?></a>
      <a href="/women_in_tech_php/community/index.php?lang=<?= e($lang) ?>"><?= t('community') ?></a>
      <a href="/women_in_tech_php/jobs/index.php?lang=<?= e($lang) ?>"><?= t('jobs') ?></a>
      <a href="/women_in_tech_php/jobs/career_match.php?lang=<?= e($lang) ?>"><?= t('career_match') ?></a>
      <a href="/women_in_tech_php/teach/course_submit.php?lang=<?= e($lang) ?>"><?= t('teach_course') ?></a>
    </nav>
    <div class="nav-actions">
      <?php $path = strtok($_SERVER['REQUEST_URI'], '?'); $query = $_GET; unset($query['lang']); ?>
      <select onchange="location.href=this.value" aria-label="<?= t('language') ?>">
        <?php foreach (['en'=>'English','ar'=>'العربية','ckb'=>'کوردی سۆرانی','kurdish_badini'=>'کوردی بادینی'] as $code=>$label): ?>
          <?php $q=$query; $q['lang']=$code; ?>
          <option value="<?= e($path.'?'.http_build_query($q)) ?>" <?= $lang===$code?'selected':'' ?>><?= $label ?></option>
        <?php endforeach; ?>
      </select>
      <button class="icon-btn" id="themeToggle" type="button" title="<?=e(t('theme'))?>">🌙</button>
      <?php if (isLoggedIn()): ?>
        <a class="btn small" href="/women_in_tech_php/dashboard/index.php?lang=<?= e($lang) ?>"><?= t('dashboard') ?></a>
        <a class="text-btn" href="/women_in_tech_php/auth/logout.php?lang=<?= e($lang) ?>"><?= t('logout') ?></a>
      <?php else: ?>
        <a class="text-btn" href="/women_in_tech_php/auth/login.php?lang=<?= e($lang) ?>"><?= t('login') ?></a>
        <a class="btn small" href="/women_in_tech_php/auth/register.php?lang=<?= e($lang) ?>"><?= t('register') ?></a>
      <?php endif; ?>
    </div>
  </div>
</header>
<main>