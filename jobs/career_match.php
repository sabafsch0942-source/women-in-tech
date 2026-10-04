<?php
require_once __DIR__.'/../includes/bootstrap.php';
$roles=[
 'frontend'=>['title'=>'role_frontend','desc'=>'role_frontend_desc','skills'=>'role_frontend_skills','courses'=>[1,2,7]],
 'security'=>['title'=>'role_security','desc'=>'role_security_desc','skills'=>'role_security_skills','courses'=>[5,9]],
 'data_ai'=>['title'=>'role_data_ai','desc'=>'role_data_ai_desc','skills'=>'role_data_ai_skills','courses'=>[6,10,11]],
 'uiux'=>['title'=>'role_uiux','desc'=>'role_uiux_desc','skills'=>'role_uiux_skills','courses'=>[3]],
 'it_support'=>['title'=>'role_it_support','desc'=>'role_it_support_desc','skills'=>'role_it_support_skills','courses'=>[1,5]],
 'cloud'=>['title'=>'role_cloud','desc'=>'role_cloud_desc','skills'=>'role_cloud_skills','courses'=>[12]],
];
$questions=[
 ['q'=>'q1','options'=>['q1a','q1b','q1c','q1d','q1e','q1f']],
 ['q'=>'q2','options'=>['q2a','q2b','q2c','q2d','q2e','q2f']],
 ['q'=>'q3','options'=>['q3a','q3b','q3c','q3d','q3e','q3f']],
 ['q'=>'q4','options'=>['q4a','q4b','q4c','q4d','q4e','q4f']],
 ['q'=>'q5','options'=>['q5a','q5b','q5c','q5d','q5e','q5f']],
 ['q'=>'q6','options'=>['q6a','q6b','q6c','q6d','q6e','q6f']],
 ['q'=>'q7','options'=>['q7a','q7b','q7c','q7d','q7e','q7f']],
 ['q'=>'q8','options'=>['q8a','q8b','q8c','q8d','q8e','q8f']],
 ['q'=>'q9','options'=>['q9a','q9b','q9c','q9d','q9e','q9f']],
 ['q'=>'q10','options'=>['q10a','q10b','q10c','q10d','q10e','q10f']],
];
$weights=[
 'q1a'=>['frontend'=>3],'q1b'=>['security'=>3],'q1c'=>['data_ai'=>3],'q1d'=>['uiux'=>3],'q1e'=>['it_support'=>3],'q1f'=>['cloud'=>3],
 'q2a'=>['frontend'=>2],'q2b'=>['security'=>2],'q2c'=>['data_ai'=>2],'q2d'=>['uiux'=>2],'q2e'=>['it_support'=>2],'q2f'=>['cloud'=>2],
 'q3a'=>['frontend'=>2],'q3b'=>['security'=>2],'q3c'=>['data_ai'=>2],'q3d'=>['uiux'=>2],'q3e'=>['it_support'=>2],'q3f'=>['cloud'=>2],
 'q4a'=>['frontend'=>1],'q4b'=>['security'=>1],'q4c'=>['data_ai'=>1],'q4d'=>['uiux'=>1],'q4e'=>['it_support'=>1],'q4f'=>['cloud'=>1],
 'q5a'=>['frontend'=>2],'q5b'=>['security'=>2],'q5c'=>['data_ai'=>2],'q5d'=>['uiux'=>2],'q5e'=>['it_support'=>2],'q5f'=>['cloud'=>2],
 'q6a'=>['frontend'=>1],'q6b'=>['security'=>1],'q6c'=>['data_ai'=>1],'q6d'=>['uiux'=>1],'q6e'=>['it_support'=>1],'q6f'=>['cloud'=>1],
 'q7a'=>['frontend'=>1],'q7b'=>['security'=>1],'q7c'=>['data_ai'=>1],'q7d'=>['uiux'=>1],'q7e'=>['it_support'=>1],'q7f'=>['cloud'=>1],
 'q8a'=>['frontend'=>2],'q8b'=>['security'=>2],'q8c'=>['data_ai'=>2],'q8d'=>['uiux'=>2],'q8e'=>['it_support'=>2],'q8f'=>['cloud'=>2],
 'q9a'=>['frontend'=>1],'q9b'=>['security'=>1],'q9c'=>['data_ai'=>2],'q9d'=>['uiux'=>1],'q9e'=>['it_support'=>1],'q9f'=>['cloud'=>2],
 'q10a'=>['frontend'=>2],'q10b'=>['security'=>2],'q10c'=>['data_ai'=>2],'q10d'=>['uiux'=>2],'q10e'=>['it_support'=>2],'q10f'=>['cloud'=>2],
];
$submitted=false;$results=[];$answers=$_POST['answers']??[];
if($_SERVER['REQUEST_METHOD']==='POST'){
 $submitted=true;$scores=array_fill_keys(array_keys($roles),0);
 foreach($questions as $question){$answer=$answers[$question['q']]??'';if(isset($weights[$answer]))foreach($weights[$answer] as $role=>$points)$scores[$role]+=$points;}
 arsort($scores);
 foreach($scores as $role=>$score) if($score>0) $results[]=[$role,$score];
}
$pageTitle=t('career_match'); require __DIR__.'/../includes/header.php'; ?>
<section class="section assessment-page"><div class="container" style="max-width:980px">
 <div class="assessment-intro"><span class="eyebrow"><?=t('career')?></span><h1><?=t('assessment_title')?></h1><p class="muted"><?=t('assessment_intro')?></p><div class="assessment-progress"><span style="width:100%"></span></div><small><?=t('assessment_questions_count')?></small></div>
 <div class="card assessment-card"><div class="assessment-header"><span class="pill">10 <?=t('questions_label')?></span><strong><?=t('assessment_answer_hint')?></strong></div>
 <form method="post" data-assessment-wizard>
 <?php foreach($questions as $index=>$question): ?><fieldset class="assessment-question"><legend><span><?=sprintf('%02d',$index+1)?></span><strong><?=t($question['q'])?></strong></legend><div class="answer-grid">
 <?php foreach($question['options'] as $option): ?><label class="answer-option"><input type="radio" name="answers[<?=$question['q']?>]" value="<?=e($option)?>" <?=($answers[$question['q']]??'')===$option?'checked':''?> required><span><?=t($option)?></span></label><?php endforeach; ?>
 </div></fieldset><?php endforeach; ?>
 <div class="assessment-nav"><button class="btn secondary assessment-prev" type="button"><?=t('previous_question')?></button><button class="btn assessment-next" type="button"><?=t('next_question')?></button><button class="btn assessment-submit" type="submit"><?=t('show_my_path')?></button></div>
 </form></div>
 <?php if($submitted): ?><div class="assessment-results"><div class="section-head"><div><h2><?=t('assessment_results_title')?></h2><p class="muted"><?=t('assessment_results_desc')?></p></div></div>
 <div class="role-grid">
 <?php foreach(array_slice($results,0,3) as [$role,$score]): $r=$roles[$role]; $percent=min(100,round(($score/18)*100)); ?>
 <article class="card role-card"><div class="role-icon">✨</div><span class="pill"><?=t('closest_match')?></span><h2><?=t($r['title'])?></h2><p class="muted"><?=t($r['desc'])?></p><div class="role-score"><div class="progressbar"><span style="width:<?=$percent?>%"></span></div><strong><?=$percent?>%</strong></div><p><strong><?=t('next_skills')?>:</strong> <?=t($r['skills'])?></p><div class="role-actions"><a class="btn" href="../courses/index.php?lang=<?=e($lang)?>&category=<?=e($role==='frontend'?'web':($role==='security'?'security':($role==='data_ai'?'data':($role==='uiux'?'design':($role==='cloud'?'cloud':'web')))))?>"><?=t('explore_path_courses')?></a></div></article>
 <?php endforeach; ?></div></div><?php endif; ?>
</div></section>
<?php require __DIR__.'/../includes/footer.php'; ?>
