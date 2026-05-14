# 🎓 Student Management System

A clean, beginner-friendly CRUD web application built with **PHP** and **MySQL**.  
Manage students — add, view, edit, delete, and search — all from a simple browser interface.

---

## Features

- **List** all students in a responsive table
- **Add** a new student with full validation
- **Edit** existing student records
- **Delete** students (with confirmation prompt)
- **View** detailed profile of a single student
- **Search** by name or email (live filter)
- Duplicate email detection
- Flash messages for success / error feedback
- Fully prepared statements (PDO) — SQL injection safe
- XSS-safe output via `htmlspecialchars`

---

## Tech Stack

| Layer    | Technology          |
|----------|---------------------|
| Backend  | PHP 8.x (PDO)       |
| Database | MySQL 5.7+ / 8.x    |
| Frontend | HTML5 + CSS3        |
| Server   | Apache (XAMPP/LAMP) |

---

## Project Structure

```
student-management-system/
├── config.php      # DB credentials & app constants
├── db.php          # PDO connection + reusable query helpers
├── index.php       # Student list + search
├── add.php         # Add student form
├── edit.php        # Edit student form
├── delete.php      # Delete handler (redirect)
├── view.php        # Single student detail page
├── style.css       # All styles
├── database.sql    # DB schema + sample data
└── README.md       # This file
```

---

## Local Setup (XAMPP)

### 1. Clone the repository

```bash
git clone https://github.com/AZEB21/Practice.git
cd Practice/student-management-system
```

### 2. Start XAMPP

Open the XAMPP Control Panel and start **Apache** and **MySQL**.

### 3. Create the database

Open **phpMyAdmin** (`http://localhost/phpmyadmin`) and run the SQL file:

```
File → Import → select database.sql → Go
```

Or run it from the MySQL CLI:

```bash
mysql -u root -p < database.sql
```

### 4. Configure credentials (if needed)

Edit `config.php` if your MySQL credentials differ from the defaults:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_db');
define('DB_USER', 'root');
define('DB_PASS', '');        // set your password here
```

### 5. Open in browser

Copy the project folder into your XAMPP `htdocs` directory:

```
C:\xampp\htdocs\student-management-system\
```

Then visit: `http://localhost/student-management-system/`

---

## Deployment (Railway / Render)

Environment variables to set on the hosting platform:

| Variable  | Example value         |
|-----------|-----------------------|
| `DB_HOST` | `mysql.railway.app`   |
| `DB_PORT` | `3306`                |
| `DB_NAME` | `student_db`          |
| `DB_USER` | `root`                |
| `DB_PASS` | `your_password`       |

The app reads these automatically via `getenv()` in `config.php`.

A `Dockerfile` and `railway.json` are included for one-click Railway deployment.

---

## Screenshots

> _Add screenshots here after running the app._

| Page          | Screenshot |
|---------------|------------|
| Student List  | ![list](screenshots/list.png) |
| Add Student   | ![add](screenshots/add.png)   |
| Edit Student  | ![edit](screenshots/edit.png) |
| View Student  | ![view](screenshots/view.png) |

---

## License

MIT — free to use and modify.
