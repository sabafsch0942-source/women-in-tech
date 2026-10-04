<?php
declare(strict_types=1);
ini_set('display_errors','1');
error_reporting(E_ALL);

require_once __DIR__ . '/../includes/bootstrap.php';

try {
    $stmt = $pdo->query("SELECT id,title_en,title_ar,title_ckb,title_badini,description_en,description_ar,description_ckb,description_badini,level,type,price_iqd,lessons_count FROM courses WHERE status='published' ORDER BY id ASC");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    die('<div style="font:16px Arial;padding:40px;color:#b00020;background:#fff0f0"><h1>Course database error</h1><pre>'.htmlspecialchars($e->getMessage(),ENT_QUOTES,'UTF-8').'</pre></div>');
}

function ctext(array $c, string $field, string $lang): string {
    $s = match($lang) {
        'ar'=>'ar','ckb'=>'ckb','kurdish_badini'=>'badini',default=>'en'
    };
    $v = trim((string)($c[$field.'_'.$s] ?? ''));
    return $v !== '' ? $v : (string)($c[$field.'_en'] ?? '');
}
function clevel(string $v,string $lang):string{
    $m=[
      'ar'=>['Beginner'=>'مبتدئ','Intermediate'=>'متوسط','Advanced'=>'متقدم'],
      'ckb'=>['Beginner'=>'سەرەتایی','Intermediate'=>'ناوەندی','Advanced'=>'پێشکەوتوو'],
      'kurdish_badini'=>['Beginner'=>'Seretayî','Intermediate'=>'Navîn','Advanced'=>'Pêşketî']
    ];
    return $m[$lang][$v]??$v;
}

$pageTitle='Courses';
require __DIR__.'/../includes/header.php';
?>
<section style="padding:55px 0 80px;background:#fbf9ff;min-height:75vh;">
<div style="width:min(1180px,92%);margin:auto;">
 
</div>

<div style="display:flex;justify-content:space-between;align-items:flex-end;gap:25px;margin-bottom:30px;">
 <div>
  <div style="display:inline-block;padding:7px 12px;border-radius:999px;background:#eadcff;color:#743bbd;font:bold 13px Arial;">LEARN • BUILD • LEAD</div>
  <h1 style="font:800 46px/1.1 Arial;margin:14px 0 10px;color:#211b2d;">Courses</h1>
  <p style="font:18px/1.5 Arial;color:#756b7f;margin:0;">Short, practical courses with projects and career-ready skills.</p>
 </div>
 <div style="display:flex;gap:10px;">
  <div style="background:#fff;border:1px solid #eee5f6;border-radius:16px;padding:16px 22px;text-align:center;"><b style="display:block;font:800 25px Arial;color:#7d43d0;"><?=count($courses)?></b><small style="font:13px Arial;color:#756b7f;">Available courses</small></div>
  <div style="background:#fff;border:1px solid #eee5f6;border-radius:16px;padding:16px 22px;text-align:center;"><b style="display:block;font:800 25px Arial;color:#7d43d0;">6</b><small style="font:13px Arial;color:#756b7f;">Learning paths</small></div>
  <div style="background:#fff;border:1px solid #eee5f6;border-radius:16px;padding:16px 22px;text-align:center;"><b style="display:block;font:800 25px Arial;color:#7d43d0;">100%</b><small style="font:13px Arial;color:#756b7f;">Practical learning</small></div>
 </div>
</div>

<div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px;">
<?php foreach($courses as $c): ?>
<article style="background:#fff;border:1px solid #e9e0f2;border-radius:20px;padding:16px;min-height:410px;display:flex;flex-direction:column;box-shadow:0 15px 35px rgba(77,42,123,.08);font-family:Arial,sans-serif;">
 <div style="height:165px;border-radius:15px;background:linear-gradient(135deg,#e4d0ff,#9b5cff);padding:18px;display:flex;flex-direction:column;justify-content:flex-end;color:#fff;">
   <div style="font-size:12px;margin-bottom:8px;opacity:.9;">COURSE #<?= (int)$c['id'] ?></div>
   <div style="font-size:21px;font-weight:800;line-height:1.25;"><?=htmlspecialchars(ctext($c,'title',$lang),ENT_QUOTES,'UTF-8')?></div>
 </div>
 <div style="display:flex;justify-content:space-between;margin:14px 0 7px;font-size:13px;color:#756b7f;">
   <span><?=htmlspecialchars(clevel((string)$c['level'],$lang),ENT_QUOTES,'UTF-8')?></span>
   <span style="background:#f0e7fa;color:#743bbd;border-radius:999px;padding:5px 9px;font-weight:800;"><?=$c['type']==='free'?'Free':($c['type']==='mixed'?'Free Start + Paid':'Paid')?></span>
 </div>
 <h2 style="font-size:21px;line-height:1.3;margin:7px 0;"><?=htmlspecialchars(ctext($c,'title',$lang),ENT_QUOTES,'UTF-8')?></h2>
 <p style="font-size:14px;line-height:1.55;color:#756b7f;margin:0 0 14px;"><?=htmlspecialchars(ctext($c,'description',$lang),ENT_QUOTES,'UTF-8')?></p>
 <div style="margin-top:auto;border-top:1px solid #eee5f6;padding:12px 0;display:flex;justify-content:space-between;font-size:13px;color:#756b7f;">
   <span>📚 <?= (int)$c['lessons_count'] ?> Lessons</span>
   <span><?=$c['price_iqd']>0?number_format((int)$c['price_iqd']).' IQD':'Free'?></span>
 </div>
 <a href="details.php?id=<?= (int)$c['id'] ?>&lang=<?=htmlspecialchars($lang,ENT_QUOTES,'UTF-8')?>" style="display:block;text-align:center;padding:12px;border-radius:12px;background:#7c42d2;color:#fff;font-weight:800;text-decoration:none;">Learn More</a>
</article>
<?php endforeach; ?>
</div>
</div>
</section>
<?php require __DIR__.'/../includes/footer.php'; ?>
