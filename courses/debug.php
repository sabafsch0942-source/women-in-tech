<?php
ini_set('display_errors','1'); 
error_reporting(E_ALL);

require_once __DIR__.'/../includes/bootstrap.php';

header('Content-Type:text/plain; charset=utf-8');

echo "DB: women_in_tech\n";
echo "Published courses: ".$pdo->query("SELECT COUNT(*) FROM courses WHERE status='published'")->fetchColumn()."\n";
echo "All courses: ".$pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn()."\n\n";

foreach($pdo->query("SELECT id,title_en,status FROM courses ORDER BY id") as $r){
  echo "#{$r['id']} | {$r['status']} | {$r['title_en']}\n";
}
