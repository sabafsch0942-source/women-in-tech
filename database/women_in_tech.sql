CREATE DATABASE IF NOT EXISTS women_in_tech CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE women_in_tech;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 role ENUM('student','teacher','admin') NOT NULL DEFAULT 'student',
 avatar VARCHAR(255) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
 id INT AUTO_INCREMENT PRIMARY KEY,
 teacher_id INT NULL,
 title_en VARCHAR(255) NOT NULL,
 title_ar VARCHAR(255) NOT NULL,
 title_ckb VARCHAR(255) NOT NULL,
 title_badini VARCHAR(255) NOT NULL,
 description_en TEXT NOT NULL,
 description_ar TEXT NOT NULL,
 description_ckb TEXT NOT NULL,
 description_badini TEXT NOT NULL,
 long_description_en TEXT NOT NULL,
 long_description_ar TEXT NOT NULL,
 long_description_ckb TEXT NOT NULL,
 long_description_badini TEXT NOT NULL,
 level VARCHAR(50) DEFAULT 'Beginner',
 type ENUM('free','mixed','paid') NOT NULL DEFAULT 'free',
 price_iqd INT NOT NULL DEFAULT 0,
 lessons_count INT NOT NULL DEFAULT 0,
 status ENUM('draft','published') NOT NULL DEFAULT 'published',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE lessons (
 id INT AUTO_INCREMENT PRIMARY KEY,
 course_id INT NOT NULL,
 lesson_order INT NOT NULL,
 title_en VARCHAR(255) NOT NULL,
 title_ar VARCHAR(255) NOT NULL,
 title_ckb VARCHAR(255) NOT NULL,
 title_badini VARCHAR(255) NOT NULL,
 video_url VARCHAR(500) NULL,
 content TEXT NULL,
 is_free TINYINT(1) NOT NULL DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE enrollments (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 course_id INT NOT NULL,
 status ENUM('pending','paid') NOT NULL DEFAULT 'pending',
 progress_percent INT NOT NULL DEFAULT 0,
 enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_enrollment(user_id,course_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE payments (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 course_id INT NOT NULL,
 amount_iqd INT NOT NULL,
 status ENUM('pending','paid','failed') NOT NULL DEFAULT 'pending',
 provider VARCHAR(80) DEFAULT 'manual',
 transaction_ref VARCHAR(190) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 course_id INT NOT NULL,
 rating TINYINT NOT NULL,
 comment TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE messages (
 id INT AUTO_INCREMENT PRIMARY KEY,
 course_id INT NOT NULL,
 sender_id INT NOT NULL,
 message TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE,
 FOREIGN KEY(sender_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE community_posts (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 title VARCHAR(255) NOT NULL,
 body TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO courses
(title_en,title_ar,title_ckb,title_badini,description_en,description_ar,description_ckb,description_badini,long_description_en,long_description_ar,long_description_ckb,long_description_badini,level,type,price_iqd,lessons_count)
VALUES
('HTML & CSS Fundamentals','أساسيات HTML و CSS','بنەماکانی HTML و CSS','بنه‌مایێن HTML و CSS',
'Build your first responsive websites.','ابني أول مواقعك المتجاوبة.','یەکەم ماڵپەڕە وەڵامدەرەوەکەت دروست بکە.','یەکەم مالپەڕێ خۆیێ وەڵامدەر دروست بکە.',
'A practical beginner course covering semantic HTML, modern CSS, Flexbox, Grid and responsive design.','دورة عملية للمبتدئات تغطي HTML الدلالي وCSS الحديث وFlexbox وGrid وتصميم المواقع المتجاوبة.','کۆرسێکی کردارییە بۆ سەرەتاییەکان و HTML و CSS و Flexbox و Grid و دیزاینی وەڵامدەر فێر دەکات.','کۆرسەکا کارپێکرنێیە بۆ دەستپێکەران و HTML و CSS و Flexbox و Grid فێر دکەت.',
'Beginner','free',0,8),
('JavaScript From Zero','جافاسكريبت من الصفر','JavaScript لە سفرەوە','JavaScript ژ سفرەوە',
'Learn JavaScript through practical browser projects.','تعلّمي JavaScript من خلال مشاريع عملية في المتصفح.','JavaScript بە پڕۆژەی کرداری فێربە.','JavaScript ب پڕۆژێن کارپێکرنێ فێربە.',
'The first lessons are free, then advanced DOM, APIs and projects require enrollment.','تبدأ الدورة بالأساسيات، ثم تنتقل إلى DOM وواجهات API والمشاريع المتقدمة التي تتطلب التسجيل.','وانە سەرەتاییەکان بەخۆڕایین؛ DOM و API و پڕۆژە پێشکەوتووەکان پارەییە.','وانەیێن سەرەتایی بێ بەرامبەرن؛ DOM و API و پڕۆژەیێن پێشکەفتی ب پارەن.',
'Beginner','mixed',15000,12),
('UI/UX Design','تصميم UI/UX','دیزاینی UI/UX','دیزاینا UI/UX',
'Design useful, accessible and beautiful digital products.','صمّمي منتجات رقمية مفيدة وسهلة الاستخدام وجميلة.','بەرھەمێن دیجیتاڵی بەسوود و جوان دیزاین بکە.','بەرهەمێن دیجیتاڵی بکاربهێنەر و جوان دروست بکە.',
'Learn user research, wireframes, visual systems, prototyping and portfolio presentation.','توێژینەوەی بەکارهێنەر، وایەرفریم، سیستەمی ڕووکاری، پرۆتۆتایپ و پۆرتفۆلیۆ فێربە.','توێژینەوەی بەکارهێنەر، وایەرفریم، پرۆتۆتایپ و پۆرتفۆلیۆ فێربە.','توێژینا بەکارهێنەر، وایەرفریم، پرۆتۆتایپ و پۆرتفۆلیۆ فێربە.',
'Intermediate','paid',25000,10),
('Python Programming','برمجة Python','پرۆگرامینگی Python','پرۆگرامینگێ Python',
'Learn Python fundamentals and build useful scripts.','تعلّمي أساسيات Python وابني برامج وسكربتات مفيدة.','تعلّمي أساسيات Python وابني برامج وسكربتات مفيدة.','بنەمایێن Python فێربە و سکریپتێن بکاربهێنەر دروست بکە.',
'Variables, conditions, loops, functions, files and a final mini project.','تعلّمي المتغيرات والشروط والحلقات والدوال والملفات، ثم طبّقي ما تعلمته في مشروع صغير نهائي.','گۆڕاوەکان، مەرجەکان، لووپ، فانکشن، فایل و پڕۆژەی کۆتایی.','گۆڕاو، مەرج، لووپ، فانکشن و فایل لگەل پڕۆژەکا کۆتایی.',
'Beginner','paid',35000,14),
('Cybersecurity Essentials','بنەماکانی ئاسایشێ سایبەری','بنەماکانی ئاسایشی سایبەری','بنه‌مایێن پاراستنا سایبەری',
'Understand cybersecurity concepts, threats and safe practices.','مفاهیم امنیت سایبری و شیوه‌های محافظت را بیاموز.','چەمکەکانی ئاسایشی سایبەری و هەڕەشەکان فێربە.','چەمکێن پاراستنا سایبەری و هەڕەشەکان فێربە.',
'Threats, authentication, secure habits, networking basics and incident awareness.','تعلّمي التهديدات والمصادقة والعادات الآمنة وأساسيات الشبكات وكيفية التعامل مع الحوادث الأمنية.','هەڕەشەکان، پشتڕاستکردنەوە و بنەماکانی تۆڕ.','هەڕەشە، پشتڕاستکرن و بنه‌مایێن تۆڕێ فێربە.',
'Intermediate','paid',50000,16),
('AI & Machine Learning Starter','مقدمة إلى الذكاء الاصطناعي وتعلّم الآلة','دەستپێکی AI و فێربوونی ماشین','دەستپێکا AI و فێربوونا ماشین',
'Start your journey into AI and machine learning.','ابدئي رحلتك في عالم الذكاء الاصطناعي وتعلّم الآلة.','سەفەرەکەت بۆ AI و فێربوونی ماشین دەست پێ بکە.','سەفەرا تە بۆ AI و فێربوونا ماشین دەست پێ بکە.',
'Learn data concepts, supervised learning, evaluation and a beginner project.','تعلّمي مفاهيم البيانات والتعلّم تحت الإشراف وطرق التقييم، وطبّقيها في مشروع مناسب للمبتدئات.','چەمکەکانی داتا، فێربوونی چاودێریکراو، هەڵسەنگاندن و پڕۆژەیەکی سەرەتایی فێربە.','چەمکێن داتا، فێربوونا چاودێکری، هەلسەنگاندن و پڕۆژەکا سەرەتایی فێربە.',
'Advanced','paid',100000,18);


INSERT INTO courses
(title_en,title_ar,title_ckb,title_badini,description_en,description_ar,description_ckb,description_badini,long_description_en,long_description_ar,long_description_ckb,long_description_badini,level,type,price_iqd,lessons_count)
VALUES
('Responsive Web Design','تصميم المواقع المتجاوبة','دیزاینی ماڵپەڕی وەڵامدەر','Dîzayna malperê ya bersivdar','Build polished responsive pages with modern layouts and accessibility.','ابني صفحات ويب متجاوبة ومنظمة مع أساسيات الوصول وسهولة الاستخدام.','ماڵپەڕی وەڵامدەر بە شێوازی نوێ و دەستگەیشتن دروست بکە.','Malperên bersivdar bi şêwazê nû û gihiştinê ava bike.','A practical next step after HTML and CSS: responsive layouts, components, accessibility and a complete landing page project.','پاش بنەماکانی HTML وCSS، ڕێکخستنی وەڵامدەر، پێکهاتەکان، دەستگەیشتن و پڕۆژەیەکی تەواوی پەڕەی ناساندن فێر دەبیت.','دوای HTML و CSS، layout ـی وەڵامدەر، component و accessibility و پڕۆژەیەکی تەواو فێربە.','Piştî HTML û CSS, layoutên bersivdar, component, gihiştin û projeyek temam fêr bibe.','Beginner','free',0,12),
('PHP & MySQL for Beginners','PHP و MySQL للمبتدئات','PHP و MySQL بۆ دەستپێکەران','PHP û MySQL ji bo destpêkeran','Build dynamic websites with PHP and connect them to MySQL.','تعلّمي بناء مواقع ديناميكية باستخدام PHP وربطها بقاعدة بيانات MySQL.','ماڵپەڕی دینامیکی بە PHP دروست بکە و بە MySQL پەیوەندی بدە.','Malperên dînamîk bi PHP ava bike û bi MySQL ve girêde.','Learn forms, sessions, CRUD, database queries and a small dashboard project.','فێری فۆرمەکان، سێشنەکان، CRUD، پرسیارەکانی داتا و پڕۆژەی داشبۆردێکی بچووک دەبیت.','فۆرم، session، CRUD، query ـی داتا و داشبۆرد فێربە.','Form, session, CRUD, query û dashboard fêr bibe.','Intermediate','paid',30000,14),
('Git & Team Collaboration','Git والعمل ضمن الفريق','Git و کاری تیمی','Git û karê tîmê','Learn Git workflows and collaborate safely on software projects.','تعلّمي Git والعمل الجماعي وإدارة التغييرات في مشاريع البرمجيات.','Git و کاری تیمی و بەڕێوەبردنی گۆڕانکارییەکان فێربە.','Git û karê tîmê û rêvebirina guhertinan fêr bibe.','Branches, commits, pull requests, resolving conflicts and a team workflow project.','الفروع وعمليات الحفظ وطلبات الدمج وحل التعارضات وسير عمل جماعي عملي.','branch وcommit وpull request و چارەسەرکردنی conflict فێربە.','branch, commit, pull request û çareserkirina conflict fêr bibe.','Beginner','free',0,9),
('Networking Fundamentals','أساسيات الشبكات','بنەماکانی تۆڕ','Bingehên torê','Understand how networks, IP addresses, DNS and common services work.','افهمي أساسيات الشبكات وعناوين IP وDNS والخدمات الشائعة.','بنەماکانی تۆڕ و IP وDNS و خزمەتگوزارییە باوەکان تێبگە.','Bingehên torê, IP, DNS û xizmetgohên hevpar fêm bike.','A beginner-friendly introduction to networking concepts with practical troubleshooting exercises.','پێشەکییەکی ئاسان بۆ تۆڕ و ڕاهێنانی کرداری بۆ دۆزینەوەی کێشەکان.','پێشەکییەکی دەستپێکەرانە بۆ تۆڕ لەگەڵ ڕاهێنانی چارەسەرکردنی کێشە.','Destpêkek ji bo torê bi rahênanên çareserkirina pirsgirêkan.','Beginner','mixed',18000,10),
('AI Tools for Everyday Work','أدوات الذكاء الاصطناعي للعمل اليومي','ئامرازەکانی AI بۆ کاری ڕۆژانە','Amûrên AI ji bo karê rojane','Use AI tools responsibly for research, writing, organization and productivity.','استخدمي أدوات الذكاء الاصطناعي بفعالية وأمان في البحث والكتابة وتنظيم العمل.','ئامرازەکانی AI بە شێوەیەکی بەرپرسیارانە بۆ توێژینەوە و نووسین و ڕێکخستنی کار بەکاربهێنە.','Amûrên AI bi berpirsiyarî ji bo lêkolîn, nivîsîn û rêkxistina kar bi kar bîne.','Prompting, verification, privacy, document workflows and a practical productivity project.','التوجيهات، التحقق من النتائج، الخصوصية، سير عمل المستندات ومشروع إنتاجية عملي.','prompting و پشتڕاستکردنەوە و تایبەتمەندی و workflow ـی بەڵگەنامەکان فێربە.','prompting, piştrastkirin, taybetmendî û workflowên belgeyan fêr bibe.','Beginner','free',0,8),
('Data Analysis with Excel & SQL','تحليل البيانات باستخدام Excel وSQL','شیکاری داتا بە Excel وSQL','Şîroveya daneyan bi Excel û SQL','Turn spreadsheets and databases into clear, useful insights.','حوّلي الجداول وقواعد البيانات إلى معلومات واضحة تساعد على اتخاذ القرار.','Spreadsheet و داتاگاکان بکە بە تێڕوانینی ڕوون و بەسوود.','Spreadsheet û database bibe agahiyên zelal û bikêr.','Clean data, write SQL queries, build simple summaries and communicate findings.','تنظيف البيانات وكتابة استعلامات SQL وبناء ملخصات بسيطة وعرض النتائج بوضوح.','پاککردنەوەی داتا و نووسینی SQL و دروستکردنی پوختە و پیشاندانی ئەنجام فێربە.','Paqijkirina daneyan, nivîsandina SQL, kurtkirin û nîşandana encaman fêr bibe.','Intermediate','paid',40000,13);

INSERT INTO lessons(course_id,lesson_order,title_en,title_ar,title_ckb,title_badini,is_free) VALUES
(1,1,'Welcome','مرحبًا','بەخێربێیت','بخێرهاتی',1),(1,2,'HTML Structure','هيكل HTML','پێکهاتەی HTML','پێکهاتەیا HTML',1),(1,3,'CSS Basics','أساسيات CSS','بنەماکانی CSS','بنه‌مایێن CSS',1),(1,4,'Flexbox','Flexbox','Flexbox','Flexbox',1),(1,5,'Grid','Grid','Grid','Grid',1),
(2,1,'JavaScript Introduction','مقدمة JavaScript','پێشەکی JavaScript','پێشەکیا JavaScript',1),(2,2,'Variables','المتغيرات','گۆڕاوەکان','گۆڕاو',1),(2,3,'DOM','DOM','DOM','DOM',0),(2,4,'APIs','واجهات API','API','API',0),(2,5,'Final Project','المشروع النهائي','پڕۆژەی کۆتایی','پڕۆژەیا کۆتایی',0),
(3,1,'Design Thinking','التفكير التصميمي','بیرکردنەوەی دیزاین','بیرکرنا دیزاینێ',0),(3,2,'Wireframes','Wireframes','وایەرفریم','وایەرفریم',0),
(4,1,'Python Basics','أساسيات Python','بنەماکانی Python','بنه‌مایێن Python',0),
(5,1,'Cybersecurity Basics','أساسيات الأمن السيبراني','بنەماکانی ئاسایشی سایبەری','بنه‌مایێن پاراستنا سایبەری',0),
(6,1,'What is AI?','ما هو الذكاء الاصطناعي؟','AI چییە؟','AI چییە؟',0);


INSERT INTO lessons(course_id,lesson_order,title_en,title_ar,title_ckb,title_badini,is_free) VALUES
(7,1,'Responsive Basics','أساسيات التصميم المتجاوب','بنەماکانی وەڵامدانەوە','Bingehên bersivdanê',1),(7,2,'Modern Layouts','التخطيطات الحديثة','ڕێکخستنە نوێکان','Layoutên nû',1),(7,3,'Flexbox and Grid','Flexbox وGrid','Flexbox وGrid','Flexbox û Grid',1),(7,4,'Accessible Interfaces','واجهات سهلة الوصول','ڕووکاری دەستگەیشتوو','Rûkarên gihiştinê',0),(7,5,'Components','المكونات','پێکهاتەکان','Component',0),(7,6,'Responsive Navigation','تنقل متجاوب','ڕێنیشاندانی وەڵامدەر','Navîgasyon bersivdar',0),(7,7,'Landing Page Project','مشروع صفحة هبوط','پڕۆژەی پەڕەی ناساندن','Projeya landing page',0),
(8,1,'PHP Basics','أساسيات PHP','بنەماکانی PHP','Bingehên PHP',1),(8,2,'Forms','النماذج','فۆرمەکان','Form',1),(8,3,'Sessions','الجلسات','Session','Session',0),(8,4,'MySQL Connection','ربط MySQL','پەیوەندی MySQL','Girêdana MySQL',0),(8,5,'CRUD','CRUD','CRUD','CRUD',0),(8,6,'Dashboard Project','مشروع لوحة التحكم','پڕۆژەی داشبۆرد','Projeya dashboard',0),
(9,1,'Why Git?','لماذا Git؟','بۆچی Git؟','Çima Git?',1),(9,2,'Commits','عمليات الحفظ','Commit','Commit',1),(9,3,'Branches','الفروع','Branch','Branch',1),(9,4,'Pull Requests','طلبات الدمج','Pull Request','Pull Request',0),(9,5,'Merge Conflicts','تعارضات الدمج','کێشەی merge','Conflictên merge',0),
(10,1,'Networks and Devices','الشبكات والأجهزة','تۆڕ و ئامێرەکان','Tor û amûr',1),(10,2,'IP Addresses','عناوين IP','ناونیشانی IP','Navnîşanên IP',1),(10,3,'DNS','DNS','DNS','DNS',1),(10,4,'Ports and Services','المنافذ والخدمات','پۆرت و خزمەتگوزاری','Port û xizmet',0),(10,5,'Troubleshooting','استكشاف الأعطال','دۆزینەوەی کێشە','Dîtina pirsgirêkan',0),
(11,1,'AI at Work','الذكاء الاصطناعي في العمل','AI لە کاردا','AI di kar de',1),(11,2,'Better Prompts','كتابة توجيهات أفضل','prompt ـی باشتر','Promptên baştir',1),(11,3,'Verification','التحقق من النتائج','پشتڕاستکردنەوە','Piştrastkirin',1),(11,4,'Privacy and Safety','الخصوصية والأمان','تایبەتمەندی و ئاسایش','Taybetmendî û ewlehî',0),(11,5,'Productivity Project','مشروع إنتاجية','پڕۆژەی بەرهەمهێنان','Projeya berhemdariyê',0),
(12,1,'Spreadsheets','الجداول','Spreadsheet','Spreadsheet',1),(12,2,'Data Cleaning','تنظيف البيانات','پاککردنەوەی داتا','Paqijkirina daneyan',1),(12,3,'SQL Queries','استعلامات SQL','پرسیارەکانی SQL','Queryên SQL',1),(12,4,'Summaries','الملخصات','پوختەکان','Kurtkirin',0),(12,5,'Presenting Insights','عرض النتائج','پیشاندانی تێڕوانین','Nîşandana têgihiştinê',0);


-- Career and instructor application features
CREATE TABLE IF NOT EXISTS jobs (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(255) NOT NULL,
 company VARCHAR(255) NOT NULL,
 location VARCHAR(255) NOT NULL,
 job_type VARCHAR(80) NOT NULL,
 description TEXT NOT NULL,
 requirements TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS job_applications (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 job_id INT NOT NULL,
 cv_path VARCHAR(500) NOT NULL,
 cover_letter TEXT NULL,
 status ENUM('pending','reviewed','accepted','rejected') NOT NULL DEFAULT 'pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_job_application(user_id,job_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(job_id) REFERENCES jobs(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS course_submissions (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 course_title VARCHAR(255) NOT NULL,
 course_description TEXT NOT NULL,
 price_iqd INT NOT NULL DEFAULT 0,
 videos_count INT NOT NULL DEFAULT 0,
 zip_path VARCHAR(500) NOT NULL,
 status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE payments ADD COLUMN IF NOT EXISTS payment_method VARCHAR(40) NOT NULL DEFAULT 'manual' AFTER amount_iqd;

INSERT INTO jobs (title,company,location,job_type,description,requirements) VALUES
('Junior Web Developer','WomenInTech Partner','Erbil, Iraq','Full-time','Build and maintain responsive websites using HTML, CSS, JavaScript and PHP.','HTML, CSS, JavaScript basics and willingness to learn PHP/MySQL.'),
('UI/UX Design Intern','Creative Digital Studio','Erbil, Iraq','Internship','Support the design team with wireframes, prototypes and visual design tasks.','Figma basics, creativity and a portfolio or university projects.'),
('Python Intern','Tech Solutions','Sulaymaniyah, Iraq','Internship','Assist with Python scripts, data processing and small automation projects.','Python basics and problem-solving skills.');
