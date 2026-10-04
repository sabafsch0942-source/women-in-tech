<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/database.php';

$supportedLanguages = ['en', 'ar', 'ckb', 'kurdish_badini'];
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'en';
if (!in_array($lang, $supportedLanguages, true)) $lang = 'en';
$_SESSION['lang'] = $lang;

$translations = [
'en'=>[
'community_intro'=>'Share your experience, ask questions, and tell other learners what you gained from a course.','community_post_hint'=>'Write a post about a course, your progress, a useful tip, or anything you want to discuss with the community.','post_title'=>'Post title','post_title_placeholder'=>'What do you want to share?','course_optional'=>'Related course (optional)','general_discussion'=>'General discussion','post_content'=>'Your post','post_content_placeholder'=>'Tell us what you learned or what you think about the course...','publish_post'=>'Publish Post','community_login_title'=>'Join the conversation','community_login_text'=>"Log in to create posts and comment on other learners' posts.",'no_posts'=>'No posts yet','no_posts_desc'=>'Be the first to share your experience with a course.','login_to_comment'=>'Log in to leave a comment.',
'home'=>'Home','courses'=>'Courses','jobs'=>'Jobs','mentors'=>'Mentors','community'=>'Community',
'login'=>'Login','register'=>'Register','logout'=>'Logout','dashboard'=>'Dashboard','language'=>'Language',
'hero_title'=>'Empowering Women to Learn, Build & Lead in Technology',
'hero_text'=>'A modern learning community for women who want to build practical technology skills, connect with mentors, and grow their careers.',
'explore_courses'=>'Explore Courses','join_now'=>'Join Now','students'=>'Students','teachers'=>'Teachers','courses_count'=>'Courses',
'free'=>'Free','paid'=>'Paid','mixed'=>'Free Start + Paid','learn_more'=>'Learn More','price'=>'Price','iqd'=>'IQD',
'search'=>'Search','all'=>'All','my_courses'=>'My Courses','progress'=>'Progress','reviews'=>'Reviews',
'comments'=>'Comments','send'=>'Send','message'=>'Message','write_comment'=>'Write a comment...',
'no_comments'=>'No comments yet. Be the first to share your experience.',
'ask_teacher'=>'Ask the Instructor','buy_course'=>'Buy Course','enroll'=>'Enroll Free','pending'=>'Payment Pending',
'paid_status'=>'Paid','free_lessons'=>'Free lessons','lessons'=>'Lessons','instructor'=>'Instructor',
'what_learn'=>'What you will learn','course_overview'=>'Course Overview','login_required'=>'Please log in first.',
'continue_learning'=>'Continue Learning','community_title'=>'Women in Tech Community','discussion'=>'Discussion',
'new_post'=>'New Post','career'=>'Career Assessment','start_assessment'=>'Start Assessment',
'light'=>'Light','dark'=>'Dark','welcome'=>'Welcome','profile'=>'Profile','certificates'=>'Certificates',
'admin'=>'Admin','teacher'=>'Teacher','student'=>'Student','email'=>'Email','password'=>'Password',
'name'=>'Full name','create_account'=>'Create Account','have_account'=>'Already have an account?',
'no_account'=>'Do not have an account?','login_error'=>'Invalid email or password.','register_error'=>'Registration failed.',
'registered'=>'Account created successfully. You can now log in.','footer'=>'Built for women in technology.','teach_course'=>'Teach a Course','career_match'=>'Career Match','find_job'=>'Find a Job That Matches Your Skills','skill_intro'=>'Answer a few questions about your skills and we will show matching jobs.','yes'=>'Yes','no'=>'No','see_matches'=>'See Matching Jobs','apply'=>'Apply Now','job_details'=>'Job Details','requirements'=>'Requirements','submit_cv'=>'Submit Your CV','course_title'=>'Course Title','course_description'=>'Course Description','video_count'=>'Number of Videos','course_zip'=>'Course Videos ZIP','submit_course'=>'Submit Course','payment_method'=>'Payment Method','transaction_reference'=>'Transaction Reference','choose_payment'=>'Choose how you want to pay','qicard'=>'Qi Card','fib'=>'FIB','qicard_desc'=>'Pay securely through the Qi Card payment gateway.','fib_desc'=>'Pay through FIB using the official payment flow, QR code, or payment link.','cardholder_name'=>'Cardholder name','card_number'=>'Card number','expiry_date'=>'Card expiry date','cvv'=>'CVV / security code','card_security_note'=>'These fields are for the payment interface only. Card number and CVV are not stored in the website database.','qicard_fields_error'=>'Please complete the required card details.','fib_payment_reference'=>'FIB payment reference','fib_instruction'=>'Complete the payment through FIB, QR code, or the official payment link, then enter the transaction reference here.','mastercard'=>'Mastercard','cv_choose_error'=>'Please choose your CV file.','email_exists'=>'This email is already registered.','cv_submission'=>'CV Submission','admin_only'=>'Admin access only.','course_not_found'=>'Course not found.','course_info_error'=>'Please fill in all course information and enter the number of videos.','zip_upload_error'=>'Please upload the ZIP file containing your course videos.','zip_type_error'=>'The course file must be a ZIP file.','zip_size_error'=>'The ZIP file must be smaller than 500 MB.'
],
'ar'=>[
'community_intro'=>'شاركي تجربتك، اطرحي الأسئلة، وأخبري المتعلمات بما استفدتِ منه في الدورات.','community_post_hint'=>'اكتبي منشورًا عن دورة، أو تجربتك، أو تقدمك، أو أي فكرة تريدين مشاركتها مع المجتمع.','post_title'=>'عنوان المنشور','post_title_placeholder'=>'ماذا تريدين أن تشاركي؟','course_optional'=>'الدورة المرتبطة (اختياري)','general_discussion'=>'نقاش عام','post_content'=>'محتوى المنشور','post_content_placeholder'=>'اكتبي ماذا تعلمتِ أو ما رأيكِ بالدورة...','publish_post'=>'نشر المنشور','community_login_title'=>'انضمي إلى النقاش','community_login_text'=>'سجلي الدخول لإنشاء منشورات وكتابة تعليقات على منشورات المتعلمات.','no_posts'=>'لا توجد منشورات بعد','no_posts_desc'=>'كوني أول من يشارك تجربته مع إحدى الدورات.','login_to_comment'=>'سجلي الدخول لكتابة تعليق.',
'home'=>'الرئيسية','courses'=>'الدورات','jobs'=>'الوظائف','mentors'=>'المرشدات','community'=>'المجتمع',
'login'=>'تسجيل الدخول','register'=>'إنشاء حساب','logout'=>'تسجيل الخروج','dashboard'=>'لوحة التحكم','language'=>'اللغة',
'hero_title'=>'تمكين النساء للتعلّم والبناء والقيادة في مجال التكنولوجيا',
'hero_text'=>'منصة تعليمية حديثة للنساء لتعلّم مهارات تقنية عملية والتواصل مع المدرّسات والمرشدات وتطوير المسار المهني.',
'explore_courses'=>'استكشفي الدورات','join_now'=>'انضمي الآن','students'=>'الطالبات','teachers'=>'المدرّسات','courses_count'=>'الدورات',
'free'=>'مجاني','paid'=>'مدفوع','mixed'=>'بداية مجانية + مدفوع','learn_more'=>'التفاصيل','price'=>'السعر','iqd'=>'دينار عراقي',
'search'=>'بحث','all'=>'الكل','my_courses'=>'دوراتي','progress'=>'التقدم','reviews'=>'التقييمات',
'comments'=>'التعليقات','send'=>'إرسال','message'=>'رسالة','write_comment'=>'اكتبي تعليقك...',
'no_comments'=>'لا توجد تعليقات بعد. كوني أول من يشارك تجربتهن.',
'ask_teacher'=>'تحدثي مع المدرّسة','buy_course'=>'شراء الدورة','enroll'=>'الاشتراك مجانًا','pending'=>'الدفع قيد المراجعة',
'paid_status'=>'مدفوع','free_lessons'=>'دروس مجانية','lessons'=>'الدروس','instructor'=>'المدرّسة',
'what_learn'=>'ماذا ستتعلمين','course_overview'=>'عن الدورة','login_required'=>'يرجى تسجيل الدخول أولًا.',
'continue_learning'=>'متابعة التعلم','community_title'=>'مجتمع النساء في التكنولوجيا','discussion'=>'نقاش',
'new_post'=>'منشور جديد','career'=>'اختبار المسار المهني','start_assessment'=>'ابدئي الاختبار',
'light'=>'فاتح','dark'=>'داكن','welcome'=>'مرحبًا','profile'=>'الملف الشخصي','certificates'=>'الشهادات',
'admin'=>'الإدارة','teacher'=>'مدرّسة','student'=>'طالبة','email'=>'البريد الإلكتروني','password'=>'كلمة المرور',
'name'=>'الاسم الكامل','create_account'=>'إنشاء حساب','have_account'=>'لديكِ حساب بالفعل؟',
'no_account'=>'ليس لديكِ حساب؟','login_error'=>'البريد الإلكتروني أو كلمة المرور غير صحيحة.','register_error'=>'فشل إنشاء الحساب.',
'registered'=>'تم إنشاء الحساب بنجاح. يمكنكِ تسجيل الدخول الآن.','footer'=>'منصة صُممت لدعم النساء في التكنولوجيا.','teach_course'=>'تقديم دورة','career_match'=>'مطابقة الوظائف','find_job'=>'اعثري على وظيفة تناسب مهاراتك','skill_intro'=>'أجيبي عن بعض الأسئلة حول مهاراتك وسنعرض الوظائف المناسبة.','yes'=>'نعم','no'=>'لا','see_matches'=>'عرض الوظائف المناسبة','apply'=>'تقديم الآن','job_details'=>'تفاصيل الوظيفة','requirements'=>'المهارات المطلوبة','submit_cv'=>'تقديم السيرة الذاتية','course_title'=>'اسم الدورة','course_description'=>'وصف الدورة','video_count'=>'عدد الفيديوهات','course_zip'=>'ملف فيديوهات الدورة ZIP','submit_course'=>'إرسال الدورة','payment_method'=>'طريقة الدفع','transaction_reference'=>'رقم العملية','choose_payment'=>'اختاري طريقة الدفع','qicard'=>'كي كارد (Qi Card)','fib'=>'FIB','qicard_desc'=>'الدفع عبر بوابة كي كارد.','fib_desc'=>'الدفع عبر FIB من خلال تطبيق البنك أو رابط/QR للدفع.','cardholder_name'=>'اسم حامل البطاقة','card_number'=>'رقم البطاقة','expiry_date'=>'تاريخ انتهاء البطاقة','cvv'=>'CVV / رمز الأمان','card_security_note'=>'هذه الحقول مخصصة لواجهة الدفع فقط. لا يتم حفظ رقم البطاقة أو CVV في قاعدة بيانات الموقع.','qicard_fields_error'=>'يرجى إكمال بيانات البطاقة المطلوبة.','fib_payment_reference'=>'رقم العملية بعد الدفع من FIB','fib_instruction'=>'أكملي الدفع من خلال FIB أو QR أو رابط الدفع الرسمي، ثم أدخلي رقم العملية هنا.','mastercard'=>'ماستركارد',
'learn_together'=>'تعلّمي معًا، اطرحي الأسئلة، وتعرّفي على نساء أخريات في مجال التكنولوجيا.','free_mixed_premium'=>'مسارات تعليمية مجانية ومختلطة ومدفوعة.','course_conversations'=>'محادثات خاصة بالدورة مع المدرّسات.','learner_feedback'=>'آراء المتعلمات وتقييمات الدورات.','teach_intro'=>'هل لديكِ دورة؟ أخبرينا عنها، حددي السعر وعدد الفيديوهات، وارفعِي جميع الفيديوهات في ملف ZIP واحد.','course_payment'=>'دفع الدورة','pay_for'=>'الدفع مقابل','choose_payment_desc'=>'اختاري طريقة الدفع:','payment_reference_desc'=>'أدخلي رقم العملية بعد إتمام الدفع.','live_payment_note'=>'هذا المشروع يسجل طلب الدفع فقط. الدفع الحقيقي عبر كي كارد يحتاج إلى البوابة الآمنة الرسمية، والدفع الحقيقي عبر FIB يحتاج إلى بيانات الاعتماد وربط API الرسمي.','submit_payment'=>'إرسال طلب الدفع','payment_success'=>'تم إرسال طلب الدفع. ستُفتح الدورة بعد تأكيد الدفع.','course_not_found'=>'الدورة غير موجودة.','job_not_found'=>'الوظيفة غير موجودة.','job_description'=>'وصف الوظيفة','upload_cv'=>'ارفعي سيرتك الذاتية وأضيفي رسالة قصيرة إن أردتِ.','cv_formats'=>'السيرة الذاتية (PDF, DOC, DOCX)','cover_letter'=>'رسالة التقديم','cover_letter_placeholder'=>'اكتبي باختصار عن مهاراتك وخبرتك...','cv_success'=>'تم إرسال سيرتك الذاتية بنجاح.','cv_size_error'=>'يجب أن يكون حجم السيرة الذاتية أقل من 5 ميغابايت.','cv_type_error'=>'يجب أن تكون السيرة الذاتية بصيغة PDF أو DOC أو DOCX.','matching_none'=>'لم نجد وظائف مطابقة بعد. حاولي اختيار مهارات أكثر.','skills_matched'=>'مهارات مطابقة','matched'=>'المهارات المطابقة','job_intro'=>'ابحثي عن وظيفة، اقرئي متطلباتها، وقدمي عليها بسيرتك الذاتية.','users'=>'المستخدمات','pending_payments'=>'مدفوعات قيد المراجعة','languages'=>'اللغات','admin_notes'=>'ملاحظات الإدارة','admin_notes_text'=>'يمكن تطوير لوحة الإدارة لإدارة المستخدمات والدورات والتعليقات والمدفوعات. قاعدة البيانات تحتوي بالفعل على الجداول المطلوبة.','theme'=>'المظهر','language_names'=>'English · العربية · کوردی سۆرانی · کوردی بادینی','teach_title'=>'التدريس في WomenInTech','price_iqd'=>'السعر (بالدينار العراقي)','zip_help'=>'الحد الأقصى 500 ميغابايت. ضعي جميع فيديوهات الدورة داخل ملف ZIP.','course_submitted'=>'تم إرسال الدورة للمراجعة.','payment_choose_error'=>'اختاري طريقة الدفع.','payment_ref_error'=>'أدخلي رقم الدفع أو رقم العملية.','course_continue_note'=>'اختاري كي كارد أو FIB في صفحة الدفع.','course_not_found'=>'الدورة غير موجودة.','learn_projects'=>'مشاريع عملية','career_skills'=>'مهارات جاهزة لسوق العمل','community_support'=>'دعم المجتمع','learn_build_lead'=>'تعلّمي. ابنِي. قودي.','practical_education'=>'تعليم تقني عملي.','learning_progress'=>'التقدم في التعلم','completed'=>'مكتمل','footer_languages'=>'العربية · English · کوردی سۆرانی · کوردی بادینی','cv_choose_error'=>'يرجى اختيار ملف السيرة الذاتية.','email_exists'=>'هذا البريد الإلكتروني مسجل بالفعل.','cv_submission'=>'تقديم السيرة الذاتية','admin_only'=>'الدخول مخصص للإدارة فقط.','course_not_found'=>'الدورة غير موجودة.','course_info_error'=>'يرجى إكمال جميع معلومات الدورة وإدخال عدد الفيديوهات.','zip_upload_error'=>'يرجى رفع ملف ZIP الذي يحتوي على فيديوهات الدورة.','zip_type_error'=>'يجب أن يكون ملف الدورة بصيغة ZIP.','zip_size_error'=>'يجب أن يكون حجم ملف ZIP أقل من 500 ميغابايت.'
],
'ckb'=>[
'community_intro'=>'ئەزموونەکەت هاوبەش بکە، پرسیار بکە و باسی ئەوە بکە چیت لە کۆرسەکە فێربووە.','community_post_hint'=>'پۆستێک لەسەر کۆرس، پێشکەوتنت، تێبینییەکی بەسوود یان هەر بابەتێک بنووسە.','post_title'=>'ناونیشانی پۆست','post_title_placeholder'=>'دەتەوێت چی هاوبەش بکەیت؟','course_optional'=>'کۆرسی پەیوەندیدار (ئارەزوومەندانە)','general_discussion'=>'گفتوگۆی گشتی','post_content'=>'ناوەڕۆکی پۆست','post_content_placeholder'=>'بنووسە چیت فێربووە یان ڕات لە کۆرسەکە چییە...','publish_post'=>'بڵاوکردنەوەی پۆست','community_login_title'=>'بەشداری گفتوگۆ بکە','community_login_text'=>'بچۆ ژوورەوە بۆ دروستکردنی پۆست و نووسینی کۆمێنت.','no_posts'=>'هێشتا پۆست نییە','no_posts_desc'=>'یەکەم کەس بە کە ئەزموونی خۆت لەگەڵ کۆرسێک هاوبەش دەکەیت.','login_to_comment'=>'بچۆ ژوورەوە بۆ نووسینی کۆمێنت.',
'home'=>'سەرەکی','courses'=>'کۆرسەکان','jobs'=>'کارەکان','mentors'=>'ڕێبەرەکان','community'=>'کۆمەڵگا',
'login'=>'چوونەژوورەوە','register'=>'دروستکردنی هەژمار','logout'=>'چوونەدەرەوە','dashboard'=>'داشبۆرد','language'=>'زمان',
'hero_title'=>'توانابوونی ژنان بۆ فێربوون، دروستکردن و سەرکردایەتی لە تەکنەلۆجیا',
'hero_text'=>'پلاتفۆرمێکی نوێ بۆ ژنان بۆ فێربوونی شارەزایی تەکنیکی، پەیوەندی بە ڕاهێنەران و گەشەپێدانی ڕێگای پیشەیی.',
'explore_courses'=>'گەڕان بەدوای کۆرسەکان','join_now'=>'ئێستا بەشداربە','students'=>'خوێندکاران','teachers'=>'مامۆستایان','courses_count'=>'کۆرس',
'free'=>'بەخۆڕایی','paid'=>'پارەدان','mixed'=>'دەستپێکی بەخۆڕایی + پارەدان','learn_more'=>'زیاتر بزانە','price'=>'نرخ','iqd'=>'دیناری عێراقی',
'search'=>'گەڕان','all'=>'هەموو','my_courses'=>'کۆرسەکانم','progress'=>'پێشکەوتن','reviews'=>'هەڵسەنگاندنەکان',
'comments'=>'کۆمێنتەکان','send'=>'ناردن','message'=>'نامە','write_comment'=>'کۆمێنتەکەت بنووسە...',
'no_comments'=>'هێشتا کۆمێنت نییە. یەکەم کەس بە لێدوانی خۆت بە.',
'ask_teacher'=>'گفتوگۆ لەگەڵ مامۆستا','buy_course'=>'کڕینی کۆرس','enroll'=>'بەخۆڕایی بەشداربە','pending'=>'پارەدان لە ژێر پشکنینە',
'paid_status'=>'پارەدراوە','free_lessons'=>'وانە بەخۆڕاییەکان','lessons'=>'وانەکان','instructor'=>'مامۆستا',
'what_learn'=>'چی فێردەبیت','course_overview'=>'دەربارەی کۆرس','login_required'=>'تکایە سەرەتا بچۆ ژوورەوە.',
'continue_learning'=>'بەردەوام بە لە فێربوون','community_title'=>'کۆمەڵگای ژنان لە تەکنەلۆجیا','discussion'=>'گفتوگۆ',
'new_post'=>'بابەتی نوێ','career'=>'هەڵسەنگاندنی ڕێگای پیشەیی','start_assessment'=>'دەستپێکردنی هەڵسەنگاندن',
'light'=>'ڕوون','dark'=>'تاریک','welcome'=>'بەخێربێیت','profile'=>'پرۆفایل','certificates'=>'بڕوانامەکان',
'admin'=>'بەڕێوەبەر','teacher'=>'مامۆستا','student'=>'خوێندکار','email'=>'ئیمەیڵ','password'=>'وشەی نهێنی',
'name'=>'ناوی تەواو','create_account'=>'دروستکردنی هەژمار','have_account'=>'هەژمارت هەیە؟',
'no_account'=>'هەژمارت نییە؟','login_error'=>'ئیمەیڵ یان وشەی نهێنی هەڵەیە.','register_error'=>'دروستکردنی هەژمار سەرکەوتوو نەبوو.',
'registered'=>'هەژمارەکە بە سەرکەوتوویی دروستکرا. ئێستا دەتوانیت بچیتە ژوورەوە.','footer'=>'دروستکراوە بۆ پشتگیری ژنان لە تەکنەلۆجیا.','teach_course'=>'پێشکەشکردنی کۆرس','career_match'=>'گونجاندنی کار','find_job'=>'کارێک بدۆزەرەوە کە لەگەڵ شارەزاییەکانت بگونجێت','skill_intro'=>'چەند پرسیارێک دەربارەی شارەزاییەکانت وەڵام بدەرەوە و ئێمە کارە گونجاوەکان نیشانت دەدەین.','yes'=>'بەڵێ','no'=>'نەخێر','see_matches'=>'کارە گونجاوەکان ببینە','apply'=>'ئێستا پێشکەش بکە','job_details'=>'وردەکارییەکانی کار','requirements'=>'شارەزاییە پێویستەکان','submit_cv'=>'ناردنی CV','course_title'=>'ناوی کۆرس','course_description'=>'وەسفی کۆرس','video_count'=>'ژمارەی ڤیدیۆکان','course_zip'=>'فایلی ZIP ـی ڤیدیۆکان','submit_course'=>'ناردنی کۆرس','payment_method'=>'شێوازی پارەدان','transaction_reference'=>'ژمارەی مامەڵە','choose_payment'=>'شێوازی پارەدان هەڵبژێرە','qicard'=>'Qi Card','fib'=>'FIB','qicard_desc'=>'پارەدان بە ڕێگەی دەروازەی Qi Card.','fib_desc'=>'پارەدان لە ڕێگەی FIB و QR یان بەستەری پارەدان.','cardholder_name'=>'ناوی خاوەنی کارت','card_number'=>'ژمارەی کارت','expiry_date'=>'بەرواری بەسەرچوونی کارت','cvv'=>'CVV / کۆدی پاراستن','card_security_note'=>'ئەم خانانە تەنها بۆ ڕووکاری پارەدانن و ژمارەی کارت و CVV هەڵناگیرێن.','qicard_fields_error'=>'تکایە زانیارییەکانی کارت پڕبکەرەوە.','fib_payment_reference'=>'ژمارەی مامەڵە دوای پارەدان لە FIB','fib_instruction'=>'پارەدان لە FIB یان QR یان بەستەری پارەدانی فەرمی تەواو بکە، پاشان ژمارەی مامەڵە بنووسە.','mastercard'=>'Mastercard','cv_choose_error'=>'تکایە فایلی CV ـەکەت هەڵبژێرە.','email_exists'=>'ئەم ئیمەیڵە پێشتر تۆمارکراوە.','cv_submission'=>'ناردنی CV','admin_only'=>'تەنها بەڕێوەبەر دەتوانێت بچێتە ژوورەوە.','course_not_found'=>'کۆرسەکە نەدۆزرایەوە.','course_info_error'=>'تکایە هەموو زانیارییەکانی کۆرس پڕبکەرەوە و ژمارەی ڤیدیۆکان بنووسە.','zip_upload_error'=>'تکایە فایلی ZIP ـی ڤیدیۆکانی کۆرس باربکە.','zip_type_error'=>'فایلی کۆرس دەبێت ZIP بێت.','zip_size_error'=>'قەبارەی فایلی ZIP دەبێت کەمتر لە 500 مێگابایت بێت.'
],
'kurdish_badini'=>[
'community_intro'=>'Ezûna xwe parve bike, pirsan bike û bibêje tu ji kursê çi fêr bûyî.','community_post_hint'=>'Postek li ser kursê, pêşveçûna xwe, şîroveyek bikêr an her mijarek binivîse.','post_title'=>'Sernavê postê','post_title_placeholder'=>'Tu dixwazî çi parve bikî?','course_optional'=>'Kursa têkildar (bijartî)','general_discussion'=>'Nîqaşa giştî','post_content'=>'Naveroka postê','post_content_placeholder'=>'Binivîse tu çi fêr bûyî an raya te li ser kursê çi ye...','publish_post'=>'Postê belav bike','community_login_title'=>'Beşdarî nîqaşê bibe','community_login_text'=>'Têkeve hesabê xwe da ku post û şîroveyan binivîsî.','no_posts'=>'Hîn post tune','no_posts_desc'=>'Yekem kes be ku ezûna xwe ya kursê parve dike.','login_to_comment'=>'Ji bo şîrovekirinê têkeve hesabê xwe.',
'home'=>'سەرەکی','courses'=>'کۆرس','jobs'=>'کار','mentors'=>'ڕێبەر','community'=>'کۆمەڵگە',
'login'=>'چوونە ژوور','register'=>'هەژمار چێکرن','logout'=>'چوونە دەر','dashboard'=>'داشبۆرد','language'=>'زمان',
'hero_title'=>'بەهێزکرنا ژنان بۆ فێربوون، دروستکرن و سەرکردایەتی ل تەکنەلۆجیا',
'hero_text'=>'پلاتفۆرمەکا نوێ بۆ ژنان بۆ فێربوونا شارەزاییێن تەکنیکی، پەیوەندی ب مامۆستایان و پێشخستنا کارێ خۆ.',
'explore_courses'=>'گەڕین ل کۆرسان','join_now'=>'نوکە بەشداربە','students'=>'خوێندکار','teachers'=>'مامۆستا','courses_count'=>'کۆرس',
'free'=>'بێ بەرامبەر','paid'=>'ب پارە','mixed'=>'دەستپێکا بێ بەرامبەر + ب پارە','learn_more'=>'زێدەتر بزانە','price'=>'نرخ','iqd'=>'دینارێ عێراقی',
'search'=>'گەڕین','all'=>'هەمی','my_courses'=>'کۆرسێن من','progress'=>'پێشکەفتن','reviews'=>'هەلسەنگاندن',
'comments'=>'کۆمێنت','send'=>'هنارتن','message'=>'نامە','write_comment'=>'کۆمێنتا خۆ بنڤیسە...',
'no_comments'=>'هێشتا کۆمێنت نین. ئەگەر تۆ یەکەم کەس بیت، ئەزموونا خۆ بنڤیسە.',
'ask_teacher'=>'گفتوگۆ لەگەڵ مامۆستا','buy_course'=>'کڕینا کۆرسێ','enroll'=>'بێ بەرامبەر بەشداربە','pending'=>'پارەدان ل ژێر پشکنینە',
'paid_status'=>'پارەدراوە','free_lessons'=>'وانەیێن بێ بەرامبەر','lessons'=>'وانە','instructor'=>'مامۆستا',
'what_learn'=>'تو چی د فێربیت','course_overview'=>'دەربارەی کۆرسێ','login_required'=>'تکایە سەرەتا بچۆ ژوور.',
'continue_learning'=>'بەردەوام بە ل فێربوونێ','community_title'=>'کۆمەڵگەیا ژنان ل تەکنەلۆجیا','discussion'=>'گفتوگۆ',
'new_post'=>'بابەتێ نوێ','career'=>'هەلسەنگاندنا ڕێکا کارێ','start_assessment'=>'دەستپێکرنا هەلسەنگاندنێ',
'light'=>'ڕوون','dark'=>'تاریک','welcome'=>'بخێرهاتی','profile'=>'پرۆفایل','certificates'=>'بڕوانامە',
'admin'=>'بەڕێوەبەر','teacher'=>'مامۆستا','student'=>'خوێندکار','email'=>'ئیمەیڵ','password'=>'وشەی نهێنی',
'name'=>'ناڤێ تەواو','create_account'=>'هەژمار چێکە','have_account'=>'هەژمارا تە هەیە؟',
'no_account'=>'هەژمارا تە نینە؟','login_error'=>'ئیمەیڵ یان وشەی نهێنی نە دروستە.','register_error'=>'هەژمار نەهاتە چێکرن.',
'registered'=>'هەژمار بە سەرکەفتی هاتە چێکرن. نوکە دکاریت بچیتە ژوور.','footer'=>'دروستکری بۆ پشتگیریا ژنان ل تەکنەلۆجیا.','teach_course'=>'پێشکێشکرنا کۆرسێ','career_match'=>'گونجاندنا کارێ','find_job'=>'کارەکێ بدۆزەڤە کو لگەل شارەزاییێن تە بگونجیت','skill_intro'=>'چەند پرسیارێن دەربارەی شارەزاییێن تە وەڵام بدە و ئەم کارێن گونجاو نیشان ددەین.','yes'=>'بەلێ','no'=>'نەخێر','see_matches'=>'کارێن گونجاو ببینە','apply'=>'نوکە پێشکێش بکە','job_details'=>'وردەکاریێن کارێ','requirements'=>'شارەزاییێن پێویست','submit_cv'=>'هنارتنا CV','course_title'=>'ناڤێ کۆرسێ','course_description'=>'وەسفا کۆرسێ','video_count'=>'ژمارا ڤیدیۆیان','course_zip'=>'فایلێ ZIP ـی ڤیدیۆیان','submit_course'=>'هنارتنا کۆرسێ','payment_method'=>'شێوازێ پارەدانێ','transaction_reference'=>'ژمارا مامەڵێ','choose_payment'=>'شێوازێ پارەدانێ هەلبژێرە','qicard'=>'Qi Card','fib'=>'FIB','qicard_desc'=>'پارەدان ب ڕێکا بواباژا Qi Card.','fib_desc'=>'پارەدان ل ڕێکا FIB و QR یان گرێدانا پارەدانێ.','cardholder_name'=>'ناڤێ خاوەنێ کارتێ','card_number'=>'ژمارا کارتێ','expiry_date'=>'روژا دەرچوونا کارتێ','cvv'=>'CVV / کۆدا پاراستنێ','card_security_note'=>'ئەم خانە تەنێ بۆ ڕووکاری پارەدانێنە و ژمارا کارتێ و CVV ناهێتە هەڵگرتن.','qicard_fields_error'=>'تکایە زانیاریێن کارتێ پڕبکە.','fib_payment_reference'=>'ژمارا مامەڵێ دوماهی دوو پارەدانێ ل FIB','fib_instruction'=>'پارەدان ل FIB یان QR یان گرێدانا پارەدانێ فەرمی تەواو بکە، پاشی ژمارا مامەڵێ بنڤیسە.','mastercard'=>'Mastercard','cv_choose_error'=>'Ji kerema xwe pelê CV yê xwe hilbijêre.','email_exists'=>'Ev e-mail berê hatiye tomarkirin.','cv_submission'=>'Şandina CV','admin_only'=>'Tenê rêveber dikare têkeve.','course_not_found'=>'Kurs nehat dîtin.','course_info_error'=>'Ji kerema xwe hemû agahiyên kursê dagire û hejmarê vîdyoyan binivîse.','zip_upload_error'=>'Ji kerema xwe pelê ZIP yê vîdyoyên kursê bar bike.','zip_type_error'=>'Pelê kursê divê ZIP be.','zip_size_error'=>'Mezinahiya pelê ZIP divê ji 500 MB kêmtir be.'
],
];

$translations['en'] += [
'next_question'=>'Next question','previous_question'=>'Previous question',
'courses_intro'=>'Short, practical tracks that end with a skill, project, or portfolio piece.','available_courses'=>'Available courses','learning_paths'=>'Learning paths','practical_learning'=>'Practical learning','course_categories'=>'Course categories','search_courses_placeholder'=>'Search by course name or skill...','no_courses_found'=>'No courses found','no_courses_found_desc'=>'Try another search or browse all learning paths.','show_all_courses'=>'Show all courses','cat_all'=>'All','cat_web'=>'Web Development','cat_programming'=>'Programming','cat_design'=>'UI/UX Design','cat_security'=>'Cybersecurity','cat_ai'=>'AI & Machine Learning','cat_data'=>'Data & Analytics','cat_cloud'=>'Cloud & DevOps',
'assessment_title'=>'Find the technology path that fits you','assessment_intro'=>'Answer 10 short questions about what you enjoy, how you solve problems, and what you would like to build. Your result explains the skills to explore next.','assessment_questions_count'=>'10 questions · about 2 minutes','questions_label'=>'questions','assessment_answer_hint'=>'Choose one answer for each question.','show_my_path'=>'Show my technology path','assessment_results_title'=>'Your closest technology paths','assessment_results_desc'=>'These are the paths that received the strongest matches from your answers. Explore them and decide which one you want to try first.','closest_match'=>'Closest match','next_skills'=>'Next skills','explore_path_courses'=>'Explore courses',
'role_frontend'=>'Frontend Developer','role_frontend_desc'=>'Build responsive, accessible interfaces and turn ideas into working web experiences.','role_frontend_skills'=>'HTML, CSS, JavaScript, Git','role_security'=>'Cybersecurity Analyst','role_security_desc'=>'Investigate risks, understand threats, and help protect systems and users.','role_security_skills'=>'Networks, security basics, Linux, safe investigation','role_data_ai'=>'Data & AI Analyst','role_data_ai_desc'=>'Turn data into useful insights and explore practical AI workflows.','role_data_ai_skills'=>'SQL, Python, data analysis, AI fundamentals','role_uiux'=>'UI/UX Designer','role_uiux_desc'=>'Understand users and design clear, useful digital experiences.','role_uiux_skills'=>'User research, wireframes, Figma, prototyping','role_it_support'=>'IT Support Specialist','role_it_support_desc'=>'Solve everyday technology problems and help people use systems confidently.','role_it_support_skills'=>'Troubleshooting, operating systems, networks, communication','role_cloud'=>'Cloud & DevOps Engineer','role_cloud_desc'=>'Automate reliable systems, deployments, and infrastructure.','role_cloud_skills'=>'Linux, Git, cloud basics, automation',
'q1'=>'What would you most enjoy building or doing?','q1a'=>'A website people can use','q1b'=>'Protecting a system from threats','q1c'=>'Finding patterns in data','q1d'=>'Designing a simple, beautiful interface','q1e'=>'Helping someone solve a computer problem','q1f'=>'Automating a service or deployment',
'q2'=>'Which task sounds most satisfying?','q2a'=>'Writing code and seeing the page change','q2b'=>'Investigating why something is insecure','q2c'=>'Cleaning data and discovering a useful insight','q2d'=>'Sketching screens and improving user flow','q2e'=>'Diagnosing a technical issue step by step','q2f'=>'Making a system run reliably without manual work',
'q3'=>'When you face a difficult problem, you usually prefer to…','q3a'=>'Break it into small coding tasks','q3b'=>'Look for risks, weak points, and evidence','q3c'=>'Compare data and test a hypothesis','q3d'=>'Understand the person who will use the solution','q3e'=>'Ask questions and troubleshoot the basics first','q3f'=>'Automate the repetitive parts',
'q4'=>'Which learning activity sounds best?','q4a'=>'Build a small web project','q4b'=>'Complete a safe security lab','q4c'=>'Analyze a dataset','q4d'=>'Create a prototype','q4e'=>'Practice troubleshooting scenarios','q4f'=>'Deploy a small service',
'q5'=>'Which result would make you happiest?','q5a'=>'A website I can share','q5b'=>'A system with stronger defenses','q5c'=>'A clear dashboard or insight','q5d'=>'A polished prototype','q5e'=>'A solved technical problem','q5f'=>'A reliable automated workflow',
'q6'=>'Which tool area interests you most?','q6a'=>'HTML, CSS, JavaScript','q6b'=>'Networks and security tools','q6c'=>'SQL, Python and spreadsheets','q6d'=>'Figma and design tools','q6e'=>'Operating systems and support tools','q6f'=>'Linux, Git and cloud platforms',
'q7'=>'How do you prefer to work?','q7a'=>'Create and iterate quickly','q7b'=>'Investigate carefully','q7c'=>'Measure and compare','q7d'=>'Observe and design','q7e'=>'Listen, diagnose and explain','q7f'=>'Plan systems and automate',
'q8'=>'What kind of challenge attracts you?','q8a'=>'Making an interface fast and responsive','q8b'=>'Understanding how attacks happen and how to prevent them','q8c'=>'Turning messy information into a decision','q8d'=>'Making a confusing experience feel simple','q8e'=>'Helping a team stay productive when technology fails','q8f'=>'Keeping applications available and deployable',
'q9'=>'Which statement feels most like you?','q9a'=>'I like learning by building','q9b'=>'I notice security and privacy risks','q9c'=>'I enjoy numbers, logic, and patterns','q9d'=>'I care about how things look and feel','q9e'=>'I am patient when helping others','q9f'=>'I enjoy systems and automation',
'q10'=>'If you had a free weekend to learn one thing, you would choose…','q10a'=>'Build a responsive landing page','q10b'=>'Learn how to secure a small network','q10c'=>'Analyze a real dataset with Python','q10d'=>'Design an app prototype','q10e'=>'Fix and document common PC problems','q10f'=>'Deploy an app to the cloud',
];

$translations['ar'] += [
'next_question'=>'السؤال التالي','previous_question'=>'السؤال السابق',
'courses_intro'=>'مسارات قصيرة وعملية تنتهين منها بمهارة أو مشروع أو قطعة من ملف الأعمال.','available_courses'=>'دورة متاحة','learning_paths'=>'مسارات تعليمية','practical_learning'=>'تعلم عملي','course_categories'=>'تصنيفات الدورات','search_courses_placeholder'=>'ابحثي باسم الدورة أو المهارة...','no_courses_found'=>'لم نجد دورات','no_courses_found_desc'=>'جرّبي كلمة بحث أخرى أو اعرضي جميع المسارات.','show_all_courses'=>'عرض جميع الدورات','cat_all'=>'الكل','cat_web'=>'تطوير الويب','cat_programming'=>'البرمجة','cat_design'=>'تصميم UI/UX','cat_security'=>'الأمن السيبراني','cat_ai'=>'الذكاء الاصطناعي وتعلّم الآلة','cat_data'=>'البيانات والتحليلات','cat_cloud'=>'الحوسبة السحابية وDevOps',
'assessment_title'=>'اكتشفي المسار التقني الأنسب لكِ','assessment_intro'=>'أجيبي عن 10 أسئلة قصيرة حول ما تحبينه وطريقة حل المشكلات وما ترغبين في بنائه. ستظهر لكِ نتيجة واضحة مع المهارات التي يمكنكِ البدء بها.','assessment_questions_count'=>'10 أسئلة · حوالي دقيقتين','questions_label'=>'أسئلة','assessment_answer_hint'=>'اختاري إجابة واحدة لكل سؤال.','show_my_path'=>'اعرضي مساري التقني','assessment_results_title'=>'المسارات التقنية الأقرب لكِ','assessment_results_desc'=>'هذه المسارات حصلت على أعلى تطابق بناءً على إجاباتك. استكشفيها واختاري ما ترغبين في تجربته أولًا.','closest_match'=>'تطابق قريب','next_skills'=>'المهارات التالية','explore_path_courses'=>'استكشفي الدورات',
'role_frontend'=>'مطوّرة Frontend','role_frontend_desc'=>'ابني واجهات متجاوبة وسهلة الوصول وحوّلي الأفكار إلى تجارب ويب عملية.','role_frontend_skills'=>'HTML وCSS وJavaScript وGit','role_security'=>'محللة أمن سيبراني','role_security_desc'=>'حلّلي المخاطر وافهمي التهديدات وساعدي في حماية الأنظمة والمستخدمات.','role_security_skills'=>'الشبكات وأساسيات الأمن وLinux والتحقيق الآمن','role_data_ai'=>'محللة بيانات وذكاء اصطناعي','role_data_ai_desc'=>'حوّلي البيانات إلى رؤى مفيدة واستكشفي تطبيقات الذكاء الاصطناعي العملية.','role_data_ai_skills'=>'SQL وPython وتحليل البيانات وأساسيات الذكاء الاصطناعي','role_uiux'=>'مصممة UI/UX','role_uiux_desc'=>'افهمي احتياجات المستخدمات وصمّمي تجارب رقمية واضحة ومفيدة.','role_uiux_skills'=>'بحث المستخدم وWireframes وFigma والنمذجة الأولية','role_it_support'=>'أخصائية دعم تقني','role_it_support_desc'=>'حلّي المشكلات التقنية اليومية وساعدي المستخدمات على استخدام الأنظمة بثقة.','role_it_support_skills'=>'استكشاف الأعطال وأنظمة التشغيل والشبكات والتواصل','role_cloud'=>'مهندسة Cloud وDevOps','role_cloud_desc'=>'اعملي على أنظمة موثوقة وعمليات نشر وبنية تحتية مؤتمتة.','role_cloud_skills'=>'Linux وGit وأساسيات السحابة والأتمتة',
'q1'=>'ما الشيء الذي ستستمتعين أكثر ببنائه أو القيام به؟','q1a'=>'موقع إلكتروني يستخدمه الناس','q1b'=>'حماية نظام من التهديدات','q1c'=>'اكتشاف الأنماط في البيانات','q1d'=>'تصميم واجهة بسيطة وجميلة','q1e'=>'مساعدة شخص في حل مشكلة حاسوب','q1f'=>'أتمتة خدمة أو عملية نشر',
'q2'=>'أي مهمة تبدو لكِ الأكثر إرضاءً؟','q2a'=>'كتابة الكود ورؤية الصفحة تتغير','q2b'=>'التحقيق في سبب وجود ثغرة','q2c'=>'تنظيف البيانات واكتشاف نتيجة مفيدة','q2d'=>'رسم الشاشات وتحسين تجربة الاستخدام','q2e'=>'تشخيص مشكلة تقنية خطوة بخطوة','q2f'=>'جعل النظام يعمل بثبات دون عمل يدوي متكرر',
'q3'=>'عندما تواجهين مشكلة صعبة، تفضلين عادةً أن…','q3a'=>'تقسميها إلى مهام برمجية صغيرة','q3b'=>'تبحثي عن المخاطر ونقاط الضعف والأدلة','q3c'=>'تقارني البيانات وتختبري فرضية','q3d'=>'تفهمي الشخص الذي سيستخدم الحل','q3e'=>'تطرحي الأسئلة وتبدئي باستكشاف الأساسيات','q3f'=>'تؤتمتي الأجزاء المتكررة',
'q4'=>'أي نشاط تعليمي يبدو لكِ أفضل؟','q4a'=>'بناء مشروع ويب صغير','q4b'=>'إنجاز مختبر أمني آمن','q4c'=>'تحليل مجموعة بيانات','q4d'=>'إنشاء نموذج أولي','q4e'=>'التدرب على سيناريوهات الدعم التقني','q4f'=>'نشر خدمة صغيرة',
'q5'=>'أي نتيجة ستجعلكِ أسعد؟','q5a'=>'موقع أستطيع مشاركته','q5b'=>'نظام بحماية أقوى','q5c'=>'لوحة معلومات أو استنتاج واضح','q5d'=>'نموذج أولي متقن','q5e'=>'حل مشكلة تقنية','q5f'=>'سير عمل موثوق ومؤتمت',
'q6'=>'أي مجال من الأدوات يثير اهتمامك أكثر؟','q6a'=>'HTML وCSS وJavaScript','q6b'=>'الشبكات وأدوات الأمن','q6c'=>'SQL وPython والجداول','q6d'=>'Figma وأدوات التصميم','q6e'=>'أنظمة التشغيل وأدوات الدعم','q6f'=>'Linux وGit ومنصات السحابة',
'q7'=>'كيف تفضلين العمل؟','q7a'=>'الإنشاء والتجربة بسرعة','q7b'=>'التحقيق بعناية','q7c'=>'القياس والمقارنة','q7d'=>'الملاحظة والتصميم','q7e'=>'الاستماع والتشخيص والشرح','q7f'=>'تخطيط الأنظمة والأتمتة',
'q8'=>'أي نوع من التحديات يجذبك؟','q8a'=>'جعل الواجهة سريعة ومتجاوبة','q8b'=>'فهم كيف تحدث الهجمات وكيف نمنعها','q8c'=>'تحويل المعلومات غير المرتبة إلى قرار','q8d'=>'جعل تجربة مربكة تبدو بسيطة','q8e'=>'مساعدة الفريق عندما تتعطل التقنية','q8f'=>'الحفاظ على توفر التطبيقات وسهولة نشرها',
'q9'=>'أي عبارة تشبهك أكثر؟','q9a'=>'أحب التعلم من خلال البناء','q9b'=>'ألاحظ مخاطر الأمن والخصوصية','q9c'=>'أستمتع بالأرقام والمنطق والأنماط','q9d'=>'أهتم بالشكل والإحساس','q9e'=>'أتحلى بالصبر عند مساعدة الآخرين','q9f'=>'أستمتع بالأنظمة والأتمتة',
'q10'=>'لو كان لديكِ عطلة نهاية أسبوع مجانية لتعلم شيء واحد، ستختارين…','q10a'=>'بناء صفحة متجاوبة','q10b'=>'تعلم حماية شبكة صغيرة','q10c'=>'تحليل بيانات حقيقية باستخدام Python','q10d'=>'تصميم نموذج أولي لتطبيق','q10e'=>'إصلاح وتوثيق مشكلات الحاسوب الشائعة','q10f'=>'نشر تطبيق على السحابة',
];

$translations['ckb'] += [
'next_question'=>'پرسیاری داهاتوو','previous_question'=>'پرسیاری پێشوو',
'courses_intro'=>'ڕێگای کورت و کرداری کە بە شارەزایی یان پڕۆژە یان بەشێک لە پۆرتفۆلیۆ کۆتایی دێت.','available_courses'=>'کۆرسی بەردەست','learning_paths'=>'ڕێگاکانی فێربوون','practical_learning'=>'فێربوونی کرداری','course_categories'=>'پۆلەکانی کۆرس','search_courses_placeholder'=>'بە ناوی کۆرس یان شارەزایی بگەڕێ...','no_courses_found'=>'هیچ کۆرسێک نەدۆزرایەوە','no_courses_found_desc'=>'وشەیەکی تری گەڕان تاقی بکەرەوە یان هەموو ڕێگاکان ببینە.','show_all_courses'=>'هەموو کۆرسەکان ببینە','cat_all'=>'هەموو','cat_web'=>'گەشەپێدانی وێب','cat_programming'=>'پرۆگرامینگ','cat_design'=>'دیزاینی UI/UX','cat_security'=>'ئاسایشی سایبەری','cat_ai'=>'AI و فێربوونی ماشین','cat_data'=>'داتا و شیکاری','cat_cloud'=>'Cloud و DevOps',
'assessment_title'=>'ڕێگای تەکنیکی گونجاو بۆ خۆت بدۆزەرەوە','assessment_intro'=>'10 پرسیاری کورت وەڵام بدەرەوە دەربارەی ئەوەی حەزت لێیە، چۆن کێشە چارەسەر دەکەیت و چی دەتەوێت دروستی بکەیت.','assessment_questions_count'=>'10 پرسیار · نزیکەی 2 خولەک','questions_label'=>'پرسیار','assessment_answer_hint'=>'بۆ هەر پرسیارێک یەک وەڵام هەڵبژێرە.','show_my_path'=>'ڕێگای تەکنیکی من ببینە','assessment_results_title'=>'ڕێگاکانی تەکنیکی نزیکتر بۆ تۆ','assessment_results_desc'=>'ئەم ڕێگایانە لەسەر بنەمای وەڵامەکانت زیاترین گونجاندنیان هەیە.','closest_match'=>'گونجاندنی نزیک','next_skills'=>'شارەزاییەکانی داهاتوو','explore_path_courses'=>'کۆرسەکانی ڕێگا ببینە',
'role_frontend'=>'گەشەپێدەری Frontend','role_frontend_desc'=>'ڕووکاری وێبی وەڵامدەر و بەکارهێنانی ئاسان دروست بکە.','role_frontend_skills'=>'HTML وCSS وJavaScript وGit','role_security'=>'شیکەرەوەی ئاسایشی سایبەری','role_security_desc'=>'مەترسییەکان و هەڕەشەکان لێکبدەرەوە و لە پاراستنی سیستەمەکان یارمەتیدەر بە.','role_security_skills'=>'تۆڕ و بنەماکانی ئاسایش وLinux و لێکۆڵینەوەی پارێزراو','role_data_ai'=>'شیکەرەوەی داتا و AI','role_data_ai_desc'=>'داتا بگۆڕە بۆ تێڕوانینی بەسوود و کاری AIی کرداری تاقی بکەرەوە.','role_data_ai_skills'=>'SQL وPython و شیکاری داتا و بنەماکانی AI','role_uiux'=>'دیزاینەری UI/UX','role_uiux_desc'=>'پێداویستی بەکارهێنەر تێبگە و ئەزموونی دیجیتاڵی ڕوون و بەسوود دروست بکە.','role_uiux_skills'=>'توێژینەوەی بەکارهێنەر وWireframes وFigma وPrototype','role_it_support'=>'شارەزای پشتگیری IT','role_it_support_desc'=>'کێشە تەکنیکییە ڕۆژانەکان چارەسەر بکە و یارمەتی بەکارهێنەران بدە.','role_it_support_skills'=>'چارەسەرکردنی کێشە و سیستەمی کارپێکردن و تۆڕ و پەیوەندی','role_cloud'=>'ئەندازیاری Cloud وDevOps','role_cloud_desc'=>'لە سیستەمی جێگیر و بڵاوکردنەوە و بنیاتنانی زیرەکی کار بکە.','role_cloud_skills'=>'Linux وGit و بنەماکانی Cloud و ئۆتۆماتیک',
'q1'=>'چی زیاتر حەز دەکەیت دروستی بکەیت یان بیکەیت؟','q1a'=>'ماڵپەڕێک کە خەڵک بەکاری بهێنن','q1b'=>'پاراستنی سیستەمێک لە هەڕەشەکان','q1c'=>'دۆزینەوەی شێوە و پاتەرن لە داتا','q1d'=>'دیزاینکردنی ڕووکاری سادە و جوان','q1e'=>'یارمەتیدانی کەسێک بۆ چارەسەرکردنی کێشەی کۆمپیوتەر','q1f'=>'ئۆتۆماتیککردنی خزمەتگوزاری یان بڵاوکردنەوە',
'q2'=>'کام کارە زیاتر خۆشحاڵت دەکات؟','q2a'=>'نووسینی کۆد و بینینی گۆڕانی پەڕە','q2b'=>'لێکۆڵینەوەی هۆکاری کەلێنێکی ئاسایشی','q2c'=>'پاککردنەوەی داتا و دۆزینەوەی ئەنجامێکی بەسوود','q2d'=>'کێشانی شاشە و باشترکردنی ڕەوتی بەکارهێنەر','q2e'=>'دۆزینەوەی هۆکاری کێشەیەکی تەکنیکی','q2f'=>'واکردنی سیستەم بە جێگیری کار بکات',
'q3'=>'کاتێک کێشەیەکی سەختت هەیە، زۆرجار حەز دەکەیت…','q3a'=>'بیکەیت بە چەند کاری بچووک','q3b'=>'بگەڕێیت بەدوای مەترسی و خاڵە لاوازەکان','q3c'=>'داتا بەراورد بکەیت و گریمانە تاقی بکەیتەوە','q3d'=>'تێبگەیت لە کەسی بەکارهێنەر','q3e'=>'پرسیار بکەیت و لە بنەماکانەوە کێشەکە بپشکنیت','q3f'=>'بەشە دووبارەکان ئۆتۆماتیک بکەیت',
'q4'=>'کام چالاکی فێربوون باشترە؟','q4a'=>'دروستکردنی پڕۆژەیەکی بچووک لە وێب','q4b'=>'تەواوکردنی تاقیکردنەوەیەکی پارێزراوی ئاسایشی','q4c'=>'شیکردنەوەی کۆمەڵە داتا','q4d'=>'دروستکردنی Prototype','q4e'=>'ڕاهێنان لەسەر کێشەکانی پشتگیری','q4f'=>'بڵاوکردنەوەی خزمەتگوزارییەکی بچووک',
'q5'=>'کام ئەنجام دڵخۆشت دەکات؟','q5a'=>'ماڵپەڕێک کە دەتوانم بڵاوی بکەمەوە','q5b'=>'سیستەمێک بە پاراستنی بەهێزتر','q5c'=>'داشبۆردێک یان تێڕوانینێکی ڕوون','q5d'=>'Prototype ـێکی پێکهاتوو','q5e'=>'چارەسەرکردنی کێشەیەکی تەکنیکی','q5f'=>'ڕەوتێکی جێگیر و ئۆتۆماتیک',
'q6'=>'کام جۆری ئامراز زیاتر سەرنجت ڕادەکێشێت؟','q6a'=>'HTML وCSS وJavaScript','q6b'=>'تۆڕ و ئامرازەکانی ئاسایش','q6c'=>'SQL وPython وSpreadsheet','q6d'=>'Figma و ئامرازەکانی دیزاین','q6e'=>'سیستەمی کارپێکردن و ئامرازەکانی پشتگیری','q6f'=>'Linux وGit و پلاتفۆرمەکانی Cloud',
'q7'=>'چۆن حەز دەکەیت کار بکەیت؟','q7a'=>'دروستکردن و تاقیکردنەوەی خێرا','q7b'=>'لێکۆڵینەوە بە وردی','q7c'=>'پێوانەکردن و بەراوردکردن','q7d'=>'سەرنجدان و دیزاین','q7e'=>'گوێگرتن و دیاریکردن و ڕوونکردنەوە','q7f'=>'پلاندانانی سیستەم و ئۆتۆماتیک',
'q8'=>'کام جۆری ئاستەنگ سەرنجت ڕادەکێشێت؟','q8a'=>'خێرا و وەڵامدەرکردنی ڕووکاری وێب','q8b'=>'تێگەیشتن لە هێرش و ڕێگای ڕێگریکردن لێی','q8c'=>'گۆڕینی زانیارییە ئاڵۆزەکان بۆ بڕیار','q8d'=>'سادەکردنی ئەزموونێکی ئاڵۆز','q8e'=>'یارمەتیدانی تیم کاتێک تەکنەلۆجیا کێشەی هەیە','q8f'=>'بەردەوامهێشتنی ئەپەکان و ئاسانکردنی بڵاوکردنەوە',
'q9'=>'کام وتە زیاتر لەگەڵ تۆ دەگونجێت؟','q9a'=>'حەز دەکەم بە دروستکردن فێربم','q9b'=>'مەترسییەکانی ئاسایش و تایبەتمەندی دەبینم','q9c'=>'ژمارە و لۆجیک و پاتەرن حەزم لێیە','q9d'=>'گرنگی بە شێوە و هەست دەدەم','q9e'=>'لە یارمەتیدانی خەڵکدا ئارامم','q9f'=>'سیستەم و ئۆتۆماتیک حەزم لێیە',
'q10'=>'ئەگەر کۆتایی هەفتەیەکت بۆ فێربوونی شتێک هەبێت، هەڵدەبژێریت…','q10a'=>'دروستکردنی پەڕەیەکی وەڵامدەر','q10b'=>'فێربوونی پاراستنی تۆڕێکی بچووک','q10c'=>'شیکردنەوەی داتای ڕاستەقینە بە Python','q10d'=>'دیزاینکردنی Prototype ـی ئەپ','q10e'=>'چاککردن و تۆمارکردنی کێشەکانی کۆمپیوتەر','q10f'=>'بڵاوکردنەوەی ئەپێک لە Cloud',
];

$translations['kurdish_badini'] += [
'next_question'=>'پرسیارا داهاتی','previous_question'=>'پرسیارا پێشوو',
'courses_intro'=>'ڕێکێن کورت و کارپێکرنێ کۆتایی ب شارەزایی یان پرۆژە یان پارچەیەک ژ پۆرتفۆلیۆی تە دەن.','available_courses'=>'کۆرسێن بەردەست','learning_paths'=>'ڕێکێن فێربوونێ','practical_learning'=>'فێربوونا کارپێکرنێ','course_categories'=>'پۆلێن کۆرسان','search_courses_placeholder'=>'ب ناڤێ کۆرسێ یان شارەزاییێ بگەڕێ...','no_courses_found'=>'کۆرس نەهاتە دۆزین','no_courses_found_desc'=>'وشەیەکا دی بگەڕێ یان هەمی ڕێکان ببینە.','show_all_courses'=>'هەمی کۆرس ببینە','cat_all'=>'هەمی','cat_web'=>'پەرەپێدانا Web','cat_programming'=>'پرۆگرامینگ','cat_design'=>'دیزاینا UI/UX','cat_security'=>'پاراستنا سایبەری','cat_ai'=>'AI و فێربوونا ماشین','cat_data'=>'داتا و شیکاری','cat_cloud'=>'Cloud وDevOps',
'assessment_title'=>'ڕێکا تەکنیکی گونجاو بۆ تە بدۆزەڤە','assessment_intro'=>'10 پرسیارێن کورت وەڵام بدە دەربارەی ئەوەی حەز دکەی، چۆن کێشە چارەسەر دکەی و چی دڤێی دروست بکەی.','assessment_questions_count'=>'10 پرسیار · نزیکەی 2 خولەک','questions_label'=>'پرسیار','assessment_answer_hint'=>'بۆ هەر پرسیارێک تەنێ یەک وەڵام هەلبژێرە.','show_my_path'=>'ڕێکا تەکنیکی من ببینە','assessment_results_title'=>'ڕێکێن تەکنیکی نزیک بۆ تە','assessment_results_desc'=>'ئەم ڕێکان ل سەر وەڵامێن تە زیاترین گونجاندن هەیە.','closest_match'=>'گونجاندنا نزیک','next_skills'=>'شارەزاییێن داهاتوو','explore_path_courses'=>'کۆرسێن ڕێکێ ببینە',
'role_frontend'=>'Pêşvebirê Frontend','role_frontend_desc'=>'ڕووکاری webێ وەڵامدەر و ئاسان بۆ بەکارهێنەر دروست بکە.','role_frontend_skills'=>'HTML وCSS وJavaScript وGit','role_security'=>'شیکارکەرێ پاراستنا سایبەری','role_security_desc'=>'مەترسی و هەڕەشەکان لێک بدە و ل پاراستنا سیستەمان پشتگیری بکە.','role_security_skills'=>'تۆڕ و بنەمای پاراستن وLinux و لێکۆڵینا پارێزراو','role_data_ai'=>'شیکارکەرێ داتا وAI','role_data_ai_desc'=>'داتا بکە ب تێڕوانینێن بکاربهێنەر و کاری AIی کارپێکرنێ تاقی بکە.','role_data_ai_skills'=>'SQL وPython و شیکاری داتا و بنەمای AI','role_uiux'=>'دیزاینەرێ UI/UX','role_uiux_desc'=>'پێداویستیێن بەکارهێنەر تێبگە و ئەزموونا دیجیتاڵی ڕوون دروست بکە.','role_uiux_skills'=>'توێژینا بەکارهێنەر وWireframes وFigma وPrototype','role_it_support'=>'پسپۆرێ پشتگیریا IT','role_it_support_desc'=>'کێشەیێن تەکنیکی چارەسەر بکە و پشتگیریا بەکارهێنەران بکە.','role_it_support_skills'=>'چارەسەرکرنا کێشە و سیستەمێن کارپێکرن و تۆڕ و پەیوەندی','role_cloud'=>'ئەندازیاری Cloud وDevOps','role_cloud_desc'=>'ل سیستەمێن جێگیر و بڵاوکرنەوە و زیرەکی ئۆتۆماتیک کار بکە.','role_cloud_skills'=>'Linux وGit و بنەمای Cloud و ئۆتۆماتیک',
];


$translations['kurdish_badini'] += [
'q1'=>'تو چی دڤێی زێدەتر دروست بکەی یان بکەی؟','q1a'=>'مالپەڕەکا خەڵک بەکاری بینن','q1b'=>'پاراستنا سیستەمێ ژ هەڕەشەیان','q1c'=>'دۆزینا پاتەرن ل داتایێ','q1d'=>'دیزاینکرنا ڕووکەرەکا سادە و جوان','q1e'=>'هاریکاریا کەسەکی بۆ چارەسەرکرنا کێشەیا کۆمپیوتەرێ','q1f'=>'ئۆتۆماتیککرنا خزمەتگوزاری یان بڵاوکرنەوە',
'q2'=>'کام کار زێدەتر تە خۆشحاڵ دکەت؟','q2a'=>'نووسینا کۆد و دیتنا گۆڕانا پەڕەیێ','q2b'=>'لێکۆلینا هۆکارێ کەلێنەکا پاراستنێ','q2c'=>'پاککرنا داتا و دۆزینا ئەنجامەکا بکاربهێنەر','q2d'=>'کێشانا شاشە و باشترکرنا ئەزموونا بەکارهێنەر','q2e'=>'دۆزینا هۆکارێ کێشەکا تەکنیکی','q2f'=>'واکرنا سیستەمێ ب جێگیری کار بکەت',
'q3'=>'دەمێ کێشەکا سەخت هەیە، تو پتر حەز دکەی…','q3a'=>'بکەیە چەند کارێن بچووک','q3b'=>'بگەڕێی بۆ مەترسی و خاڵێن لاواز','q3c'=>'داتا بەراورد بکەی و گریمانە تاقی بکەیەوە','q3d'=>'تێبگەی ژ کەسێ کو دێ چارەسەرێ بکاربینیت','q3e'=>'پرسیاران بکەی و ژ بنەمایانەوە پشکنینێ بکەی','q3f'=>'بەشێن دووبارە ئۆتۆماتیک بکەی',
'q4'=>'کام چالاکی فێربوون باشترە؟','q4a'=>'دروستکرنا پرۆژەکا بچووک یا Web','q4b'=>'تەواوکرنا لابۆراتوارەکا پارێزراو یا پاراستنێ','q4c'=>'شیکارکرنا کۆمەڵە داتا','q4d'=>'دروستکرنا prototype','q4e'=>'ڕاهێنان ل سەر کێشێن پشتگیری','q4f'=>'بڵاوکرنا خزمەتگوزاریەکا بچووک',
'q5'=>'کام ئەنجام دێ تە زێدەتر خۆشحاڵ بکەت؟','q5a'=>'مالپەڕەکا کو دکارم بڵاڤ بکەم','q5b'=>'سیستەمەک ب پاراستنا بەهێزتر','q5c'=>'داشبۆرد یان ئەنجامەکا ڕوون','q5d'=>'prototype ـەکا باش','q5e'=>'چارەسەرکرنا کێشەکا تەکنیکی','q5f'=>'ڕەوتەکا جێگیر و ئۆتۆماتیک',
'q6'=>'کام جۆرێ ئامرازان سەرنجا تە زێدەتر ڕادکێشیت؟','q6a'=>'HTML وCSS وJavaScript','q6b'=>'تۆڕ و ئامرازێن پاراستنێ','q6c'=>'SQL وPython و spreadsheet','q6d'=>'Figma و ئامرازێن دیزاینێ','q6e'=>'سیستەمێن کارپێکرن و ئامرازێن پشتگیری','q6f'=>'Linux وGit و پلاتفۆرمێن Cloud',
'q7'=>'تو چەوا حەز دکەی کار بکەی؟','q7a'=>'دروستکرن و تاقیکرنەوە ب خێرایی','q7b'=>'لێکۆلینا ب وردی','q7c'=>'پێوانەکرن و بەراوردکرن','q7d'=>'سەرنجدان و دیزاین','q7e'=>'گوهدان و دیاریکرن و ڕوونکرنەوە','q7f'=>'پلاندانانا سیستەمان و ئۆتۆماتیک',
'q8'=>'کام جۆرێ ئاستەنگێ سەرنجا تە ڕادکێشیت؟','q8a'=>'خێرا و وەڵامدەرکرنا ڕووکەرێ','q8b'=>'تێگەهشتن ژ هێرشان و ڕێگری ژ وان','q8c'=>'گۆڕینا زانیاریێن ئاڵۆز بۆ بڕیار','q8d'=>'سادەکرنا ئەزموونەکا ئاڵۆز','q8e'=>'هاریکاریا تیمێ دەمێ تەکنەلۆجیا کێشە هەیە','q8f'=>'بەردەوامهێشتنا ئەپان و ئاسانکرنا بڵاوکرنەوە',
'q9'=>'کام وتە پتر لگەل تە دگونجیت؟','q9a'=>'حەز دکەم ب دروستکرن فێربم','q9b'=>'مەترسیێن پاراستن و تایبەتمەندی دبینم','q9c'=>'ژمارە و لۆجیک و پاتەرن حەز لێدکەم','q9d'=>'گرنگی ددەمە شێوە و هەستێ','q9e'=>'دەمێ هاریکاریا کەسان ئارامم','q9f'=>'سیستەم و ئۆتۆماتیک حەز لێدکەم',
'q10'=>'ئەگەر کۆتایی هەفتەیەکا بەتاڵ هەبیت بۆ فێربوونا شتێک، هەلبژێریت…','q10a'=>'دروستکرنا پەڕەکا وەڵامدەر','q10b'=>'فێربوونا پاراستنا تۆڕەکا بچووک','q10c'=>'شیکارکرنا داتایێن ڕاستەقینە ب Python','q10d'=>'دیزاینکرنا prototype ـێ ئەپێ','q10e'=>'چاککرن و تۆمارکرنا کێشێن کۆمپیوتەرێ','q10f'=>'بڵاوکرنا ئەپەکێ ل Cloud',
];


/* Course catalog translations. Existing translations remain untouched. */
$courseCatalogTranslations = [
    'en' => [
        'courses_intro'=>'Short, practical tracks that end with a skill, project, or portfolio piece.',
        'available_courses'=>'Available courses','learning_paths'=>'Learning paths','practical_learning'=>'Practical learning',
        'search_courses_placeholder'=>'Search courses by title or skill...','course_categories'=>'Course categories',
        'cat_all'=>'All','cat_web'=>'Web','cat_programming'=>'Programming','cat_design'=>'Design',
        'cat_security'=>'Security','cat_ai'=>'AI','cat_data'=>'Data','cat_cloud'=>'Cloud',
        'no_courses_found'=>'No courses found','no_courses_found_desc'=>'Try another search or choose All courses.',
        'show_all_courses'=>'Show all courses','learn_build_lead'=>'Learn. Build. Lead.'
    ],
    'ar' => [
        'courses_intro'=>'مسارات عملية قصيرة تنتهي بمهارة أو مشروع أو قطعة من ملف الأعمال.',
        'available_courses'=>'الدورات المتاحة','learning_paths'=>'مسارات التعلم','practical_learning'=>'تعلم عملي',
        'search_courses_placeholder'=>'ابحثي عن دورة أو مهارة...','course_categories'=>'تصنيفات الدورات',
        'cat_all'=>'الكل','cat_web'=>'الويب','cat_programming'=>'البرمجة','cat_design'=>'التصميم',
        'cat_security'=>'الأمن السيبراني','cat_ai'=>'الذكاء الاصطناعي','cat_data'=>'البيانات','cat_cloud'=>'الحوسبة السحابية',
        'no_courses_found'=>'لم يتم العثور على دورات','no_courses_found_desc'=>'جرّبي بحثًا آخر أو اختاري كل الدورات.',
        'show_all_courses'=>'عرض كل الدورات','learn_build_lead'=>'تعلّمي. ابنِي. قودي.'
    ],
    'ckb' => [
        'courses_intro'=>'ڕێگاکانی فێربوونی کرداری کورت کە بە شارەزایی، پڕۆژە یان پۆرتفۆلیۆ کۆتایی دێن.',
        'available_courses'=>'کۆرسە بەردەستەکان','learning_paths'=>'ڕێگاکانی فێربوون','practical_learning'=>'فێربوونی کرداری',
        'search_courses_placeholder'=>'گەڕان بەدوای کۆرس یان شارەزایی...','course_categories'=>'جۆرەکانی کۆرس',
        'cat_all'=>'هەموو','cat_web'=>'وێب','cat_programming'=>'پرۆگرامسازی','cat_design'=>'دیزاین',
        'cat_security'=>'ئاسایشی سایبەری','cat_ai'=>'AI','cat_data'=>'داتا','cat_cloud'=>'کلاود',
        'no_courses_found'=>'هیچ کۆرسێک نەدۆزرایەوە','no_courses_found_desc'=>'گەڕانێکی تر بکە یان هەموو کۆرسەکان هەڵبژێرە.',
        'show_all_courses'=>'هەموو کۆرسەکان پیشان بدە','learn_build_lead'=>'فێربە. دروستی بکە. سەرکردایەتی بکە.'
    ],
    'kurdish_badini' => [
        'courses_intro'=>'Rêyên fêrbûnê yên kurt û pratîk ku bi şarezayî, projeyek an portfolioyekê bi dawî dibin.',
        'available_courses'=>'Kursên berdest','learning_paths'=>'Rêyên fêrbûnê','practical_learning'=>'Fêrbûna pratîkî',
        'search_courses_placeholder'=>'Li kurs an şarezayiyê bigere...','course_categories'=>'Kategoriyên kursan',
        'cat_all'=>'Hemû','cat_web'=>'Web','cat_programming'=>'Programkirin','cat_design'=>'Dîzayn',
        'cat_security'=>'Ewlehiya Cyber','cat_ai'=>'AI','cat_data'=>'Daneyên','cat_cloud'=>'Cloud',
        'no_courses_found'=>'Tu kurs nehat dîtin','no_courses_found_desc'=>'Gereke dîtina din biceribîne an Hemû hilbijêre.',
        'show_all_courses'=>'Hemû kursan nîşan bide','learn_build_lead'=>'Fêr bibe. Ava bike. Serkêşî bike.'
    ]
];
foreach ($courseCatalogTranslations as $locale => $items) {
    $translations[$locale] = array_merge($items, $translations[$locale] ?? []);
}

function t(string $key): string {
    global $translations, $lang;
    return $translations[$lang][$key] ?? $translations['en'][$key] ?? $key;
}
function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function isLoggedIn(): bool { return isset($_SESSION['user_id']); }
function user(): ?array { return $_SESSION['user'] ?? null; }
function requireLogin(): void {
    if (!isLoggedIn()) { header('Location: /women_in_tech_php/auth/login.php'); exit; }
}
function redirect(string $url): never { header("Location: $url"); exit; }

function localizedJob(array $job): array {
    global $lang;
    $id=(int)($job['id']??0);
    $data=[
      'ar'=>[
        1=>['title'=>'مطور ويب مبتدئ','company'=>'شريك WomenInTech','location'=>'أربيل، العراق','job_type'=>'دوام كامل','description'=>'بناء وصيانة مواقع ويب متجاوبة باستخدام HTML وCSS وJavaScript وPHP.','requirements'=>'أساسيات HTML وCSS وJavaScript والاستعداد لتعلّم PHP وMySQL.'],
        2=>['title'=>'متدربة في تصميم UI/UX','company'=>'استوديو التصميم الرقمي','location'=>'أربيل، العراق','job_type'=>'تدريب','description'=>'مساعدة فريق التصميم في إعداد المخططات الأولية والنماذج الأولية ومهام التصميم المرئي.','requirements'=>'أساسيات Figma والإبداع ووجود ملف أعمال أو مشاريع جامعية.'],
        3=>['title'=>'متدربة Python','company'=>'Tech Solutions','location'=>'السليمانية، العراق','job_type'=>'تدريب','description'=>'المساعدة في كتابة سكربتات Python ومعالجة البيانات ومشاريع الأتمتة الصغيرة.','requirements'=>'أساسيات Python ومهارات حل المشكلات.']],
      'ckb'=>[
        1=>['title'=>'گەشەپێدەری وێبی سەرەتایی','company'=>'هاوبەشی WomenInTech','location'=>'هەولێر، عێراق','job_type'=>'کاتی تەواو','description'=>'دروستکردن و بەڕێوەبردنی وێبسایتی وەڵامدەرەوە بە HTML و CSS و JavaScript و PHP.','requirements'=>'بنەماکانی HTML و CSS و JavaScript و ئارەزووی فێربوونی PHP و MySQL.'],
        2=>['title'=>'ڕاهێنەر لە دیزاینی UI/UX','company'=>'ستۆدیۆی دیزاینی دیجیتاڵ','location'=>'هەولێر، عێراق','job_type'=>'ڕاهێنان','description'=>'یارمەتیدانی تیمی دیزاین لە دروستکردنی وایەرفریم و پرۆتۆتایپ و کاری دیزاینی بینراو.','requirements'=>'بنەمای Figma و داهێنان و هەبوونی پۆرتفۆلیۆ یان پرۆژەی زانکۆیی.'],
        3=>['title'=>'ڕاهێنەر لە Python','company'=>'Tech Solutions','location'=>'سلێمانی، عێراق','job_type'=>'ڕاهێنان','description'=>'یارمەتیدان لە نووسینی سکریپتی Python و پرۆسەکردنی داتا و پرۆژە بچووکەکانی ئۆتۆماتیک.','requirements'=>'بنەماکانی Python و توانای چارەسەرکردنی کێشە.']],
      'kurdish_badini'=>[
        1=>['title'=>'Pêşvebirê Webê Seretayî','company'=>'Hevkarê WomenInTech','location'=>'Hewlêr, Iraq','job_type'=>'Dema Temam','description'=>'Avakirin û parastina malperên webê bi HTML, CSS, JavaScript û PHP.','requirements'=>'Bingehên HTML, CSS û JavaScript û amadebûna fêrbûna PHP û MySQL.'],
        2=>['title'=>'Stajyera Dîzayna UI/UX','company'=>'Studyoya Dîzayna Dîjîtal','location'=>'Hewlêr, Iraq','job_type'=>'Staj','description'=>'Alîkariya tîma dîzaynê di wireframe, prototype û karên dîzayna dîtbar de.','requirements'=>'Bingehên Figma, afirînerî û portfolio an projeyên zanîngehê.'],
        3=>['title'=>'Stajyera Python','company'=>'Tech Solutions','location'=>'Silêmanî, Iraq','job_type'=>'Staj','description'=>'Alîkariya nivîsandina skrîptên Python, pêvajoya daneyan û projeyên biçûk ên otomasyonê.','requirements'=>'Bingehên Python û şiyana çareserkirina pirsgirêkan.']],
    ];
    if(isset($data[$lang][$id])) foreach($data[$lang][$id] as $k=>$v) $job[$k]=$v;
    return $job;
}


function localizedCourse(array $course): array {
    // Course text is stored in every supported language in the database.
    // Keeping localization data in one place makes Arabic/Kurdish additions scalable.
    if (isset($course['level'])) {
        global $lang;
        $levels=[
            'ar'=>['Beginner'=>'مبتدئ','Intermediate'=>'متوسط','Advanced'=>'متقدم'],
            'ckb'=>['Beginner'=>'سەرەتایی','Intermediate'=>'ناوەندی','Advanced'=>'پێشکەوتوو'],
            'kurdish_badini'=>['Beginner'=>'Seretayî','Intermediate'=>'Navîn','Advanced'=>'Pêşketî'],
        ];
        if (isset($levels[$lang][$course['level']])) $course['level']=$levels[$lang][$course['level']];
    }
    return $course;
}

function localizedColumn(string $base): string {
    global $lang;
    return match($lang) {
        'ar' => $base.'_ar',
        'ckb' => $base.'_ckb',
        'kurdish_badini' => $base.'_badini',
        default => $base.'_en'
    };
}
?>