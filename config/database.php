<?php
declare(strict_types=1);

/*
 * Database configuration for XAMPP / MySQL.
 * Default XAMPP settings: root user with an empty password.
 */
$host = 'localhost';
$db   = 'women_in_tech';
$user = 'root';
$pass = ''; // XAMPP default. If you set a MySQL password, put it here.
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // First connect to MySQL itself, so the project can create its database
    // automatically if it has not been imported yet.
    $serverDsn = "mysql:host=$host;charset=$charset";
    $serverPdo = new PDO($serverDsn, $user, $pass, $options);
    $serverPdo->exec("CREATE DATABASE IF NOT EXISTS `" . str_replace('`', '``', $db) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);

    // If the database is empty, import the included schema and seed data once.
    $tableExists = $pdo->query("SHOW TABLES LIKE 'users'")->fetchColumn();
    if (!$tableExists) {
        $sqlFile = __DIR__ . '/../database/women_in_tech.sql';
        if (is_file($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            // The SQL file contains simple CREATE/INSERT statements, so
            // executing each statement separately is sufficient here.
            $sql = preg_replace('/^\s*(CREATE DATABASE IF NOT EXISTS.*?;|USE\s+[^;]+;)\s*/is', '', $sql, 1);
            $statements = preg_split('/;\s*(?:\r?\n|$)/', $sql);
            foreach ($statements as $statement) {
                $statement = trim($statement);
                if ($statement !== '') {
                    $pdo->exec($statement);
                }
            }
        }
    }

    // Apply the idempotent course/content upgrade for existing installations too.
    $upgradeFile = __DIR__ . '/../database/upgrade_courses.sql';
    if (is_file($upgradeFile)) {
        $upgradeSql = file_get_contents($upgradeFile);
        $upgradeSql = preg_replace('/^\s*USE\s+[^;]+;\s*/i', '', $upgradeSql, 1);
        $upgradeStatements = preg_split('/;\s*(?:\r?\n|$)/', $upgradeSql);
        foreach ($upgradeStatements as $statement) {
            $statement = trim($statement);
            if ($statement !== '') {
                $pdo->exec($statement);
            }
        }
    }

    // Create the new career/payment tables for existing installations too.
    $pdo->exec("CREATE TABLE IF NOT EXISTS jobs (id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(255) NOT NULL,company VARCHAR(255) NOT NULL,location VARCHAR(255) NOT NULL,job_type VARCHAR(80) NOT NULL,description TEXT NOT NULL,requirements TEXT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS job_applications (id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,job_id INT NOT NULL,cv_path VARCHAR(500) NOT NULL,cover_letter TEXT NULL,status ENUM('pending','reviewed','accepted','rejected') NOT NULL DEFAULT 'pending',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,UNIQUE KEY unique_job_application(user_id,job_id),FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(job_id) REFERENCES jobs(id) ON DELETE CASCADE)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS course_submissions (id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,course_title VARCHAR(255) NOT NULL,course_description TEXT NOT NULL,price_iqd INT NOT NULL DEFAULT 0,videos_count INT NOT NULL DEFAULT 0,zip_path VARCHAR(500) NOT NULL,status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE)");
    $pdo->exec("CREATE TABLE IF NOT EXISTS general_cv_submissions (id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,cv_path VARCHAR(500) NOT NULL,cover_letter TEXT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE)");
    $columns = $pdo->query("SHOW COLUMNS FROM payments LIKE 'payment_method'")->fetchColumn();
    if (!$columns) { $pdo->exec("ALTER TABLE payments ADD COLUMN payment_method VARCHAR(40) NOT NULL DEFAULT 'manual' AFTER amount_iqd"); }
    $jobCount = (int)$pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
    if ($jobCount === 0) {
        $seed = $pdo->prepare("INSERT INTO jobs(title,company,location,job_type,description,requirements) VALUES(?,?,?,?,?,?)");
        $seed->execute(['Junior Web Developer','WomenInTech Partner','Erbil, Iraq','Full-time','Build and maintain responsive websites using HTML, CSS, JavaScript and PHP.','HTML, CSS, JavaScript basics and willingness to learn PHP/MySQL.']);
        $seed->execute(['UI/UX Design Intern','Creative Digital Studio','Erbil, Iraq','Internship','Support the design team with wireframes, prototypes and visual design tasks.','Figma basics, creativity and a portfolio or university projects.']);
        $seed->execute(['Python Intern','Tech Solutions','Sulaymaniyah, Iraq','Internship','Assist with Python scripts, data processing and small automation projects.','Python basics and problem-solving skills.']);
    }
} catch (PDOException $e) {
    $msg = $e->getMessage();
    $help = ' Make sure MySQL is running in XAMPP and that the username/password in config/database.php are correct.';
    die('<div style="font-family:Arial;max-width:760px;margin:50px auto;padding:24px;border:1px solid #ddd;border-radius:12px"><h2>Database connection failed</h2><p><strong>MySQL says:</strong> ' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '</p><p>' . htmlspecialchars($help, ENT_QUOTES, 'UTF-8') . '</p></div>');
}
?>
