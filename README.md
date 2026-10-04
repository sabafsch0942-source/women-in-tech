# WomenInTech PHP + MySQL

A multilingual learning/community platform built with PHP, MySQL, HTML, CSS and JavaScript.

## Included
- English / Arabic / Kurdish Sorani / Kurdish Badini
- RTL/LTR switching
- Light / dark mode
- Student registration and login
- Course catalog
- Free, mixed and paid courses
- IQD prices from 15,000 to 100,000
- Enrollment and progress fields
- Course reviews/comments
- Course-specific instructor chat
- Community posts
- Student dashboard
- Basic admin dashboard
- MySQL schema + seed courses

## Run with XAMPP
1. Install XAMPP.
2. Copy this folder into `C:/xampp/htdocs/`.
3. Start Apache and MySQL.
4. Open phpMyAdmin.
5. Import `database/women_in_tech.sql`.
6. Open:
   `http://localhost/women_in_tech_php/`

## Database configuration
Default XAMPP settings are:
- host: localhost
- database: women_in_tech
- user: root
- password: empty

If your MySQL password is different, edit `config/database.php`.

## Create an admin
Register a normal account through the website, then run in phpMyAdmin:

```sql
UPDATE users SET role='admin' WHERE email='YOUR_EMAIL';
```

## Payment note
The project includes a real database payment state (`pending`, `paid`, `failed`) and an enrollment workflow. The included "Buy Course" flow is a safe demo/manual confirmation flow. For real Iraqi online payments, connect a payment provider after choosing the provider and completing its merchant/API requirements.

## Important production upgrades
Before public deployment, add:
- CSRF tokens
- email verification
- password reset
- rate limiting
- server-side authorization for every lesson
- real payment gateway/webhook verification
- file/video storage rules
- teacher/admin CRUD screens
- chat polling/WebSocket service
- audit logs
- HTTPS and secure session cookies

## Course page fix
The course catalog was rebuilt with a scoped layout and visibility rules so course cards,
filters, search, and buttons remain visible even if older CSS rules conflict with them.
The database already contains the course catalog; `course_check.php` can be opened locally
to verify the number of published courses and lessons.


FIXED_v2: courses/index.php now renders cards with inline visibility/layout styles and includes courses/debug.php.
