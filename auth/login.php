<?php
require_once __DIR__.'/../includes/bootstrap.php';
if(isLoggedIn()) redirect('/women_in_tech_php/dashboard/index.php?lang='.urlencode($lang));
$error='';$success=$_SESSION['flash']??'';unset($_SESSION['flash']);
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=strtolower(trim($_POST['email']??''));$password=$_POST['password']??'';
 $q=$pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1");$q->execute([$email]);$u=$q->fetch();
 if($u && password_verify($password,$u['password'])){$_SESSION['user_id']=$u['id'];$_SESSION['user']=$u;redirect('/women_in_tech_php/dashboard/index.php?lang='.urlencode($lang));}
 $error=t('login_error');
}
$pageTitle=t('login');require __DIR__.'/../includes/header.php';?>
<div class="auth-wrap"><div class="auth-card"><h2><?=t('login')?></h2><?php if($success):?><div class="alert success"><?=e($success)?></div><?php endif;?><?php if($error):?><div class="alert"><?=e($error)?></div><?php endif;?>
<form method="post"><div class="field"><label><?=t('email')?></label><input type="email" name="email" required></div><div class="field"><label><?=t('password')?></label><input type="password" name="password" required></div><button class="btn" type="submit"><?=t('login')?></button></form><p class="muted"><?=t('no_account')?> <a class="brand-accent" href="register.php?lang=<?=e($lang)?>"><?=t('register')?></a></p></div></div>
<?php require __DIR__.'/../includes/footer.php'; ?>