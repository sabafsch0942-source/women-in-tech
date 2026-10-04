<?php
require_once __DIR__.'/../includes/bootstrap.php';
if(isLoggedIn()) redirect('/women_in_tech_php/dashboard/index.php?lang='.urlencode($lang));
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $password=$_POST['password']??'';
  if($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<6){$error=t('register_error');}
  else {
    $q=$pdo->prepare("SELECT id FROM users WHERE email=?");$q->execute([$email]);
    if($q->fetch()) $error=t('email_exists');
    else { $stmt=$pdo->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'student')");$stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]); $_SESSION['flash']=t('registered'); redirect('/women_in_tech_php/auth/login.php?lang='.urlencode($lang)); }
  }
}
$pageTitle=t('register'); require __DIR__.'/../includes/header.php'; ?>
<div class="auth-wrap"><div class="auth-card"><h2><?=t('create_account')?></h2><?php if($error):?><div class="alert"><?=e($error)?></div><?php endif;?>
<form method="post"><div class="field"><label><?=t('name')?></label><input name="name" required></div><div class="field"><label><?=t('email')?></label><input type="email" name="email" required></div><div class="field"><label><?=t('password')?></label><input type="password" name="password" minlength="6" required></div><button class="btn" type="submit"><?=t('create_account')?></button></form><p class="muted"><?=t('have_account')?> <a class="brand-accent" href="login.php?lang=<?=e($lang)?>"><?=t('login')?></a></p></div></div>
<?php require __DIR__.'/../includes/footer.php'; ?>