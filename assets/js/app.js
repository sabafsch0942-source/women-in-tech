(function(){
  const saved = localStorage.getItem('wit-theme');
  if(saved === 'dark') document.body.classList.add('dark');
  const btn = document.getElementById('themeToggle');
  if(btn) btn.addEventListener('click', ()=>{
    document.body.classList.toggle('dark');
    localStorage.setItem('wit-theme', document.body.classList.contains('dark') ? 'dark' : 'light');
  });
  document.querySelectorAll('[data-autosubmit]').forEach(el => el.addEventListener('change',()=>el.form.submit()));
})();(function(){
  const form=document.querySelector('[data-assessment-wizard]');
  if(!form) return;
  const questions=[...form.querySelectorAll('.assessment-question')];
  const prev=form.querySelector('.assessment-prev');
  const next=form.querySelector('.assessment-next');
  const submit=form.querySelector('.assessment-submit');
  if(!questions.length || !prev || !next || !submit) return;
  let current=0;
  const progress=document.querySelector('.assessment-progress span');
  const count=document.querySelector('.assessment-intro small');
  function update(){
    questions.forEach((q,i)=>q.style.display=i===current?'block':'none');
    prev.style.display=current===0?'none':'inline-flex';
    next.style.display=current===questions.length-1?'none':'inline-flex';
    submit.style.display=current===questions.length-1?'inline-flex':'none';
    if(progress) progress.style.width=((current+1)/questions.length*100)+'%';
    if(count) count.textContent=(current+1)+' / '+questions.length;
    const radios=questions[current].querySelectorAll('input[type=radio]');
    radios.forEach(r=>r.addEventListener('change',()=>{ if(current<questions.length-1) next.focus(); },{once:true}));
  }
  next.addEventListener('click',()=>{
    const checked=questions[current].querySelector('input[type=radio]:checked');
    if(!checked){ questions[current].classList.add('needs-answer'); return; }
    questions[current].classList.remove('needs-answer'); current++; update();
  });
  prev.addEventListener('click',()=>{if(current>0){current--;update();}});
  form.addEventListener('submit',(e)=>{
    const checked=questions[current].querySelector('input[type=radio]:checked');
    if(!checked){e.preventDefault();questions[current].classList.add('needs-answer');}
  });
  update();
})();
