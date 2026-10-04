<?php
require_once __DIR__ . '/config/database.php';
$count = (int)$pdo->query("SELECT COUNT(*) FROM courses WHERE status='published'")->fetchColumn();
$lessons = (int)$pdo->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
header('Content-Type: text/plain; charset=utf-8');
echo "WomenInTech course database check\n";
echo "Published courses: {$count}\n";
echo "Lessons: {$lessons}\n";
echo ($count > 0 ? "OK: courses are available.\n" : "ERROR: no published courses found.\n");
?>
