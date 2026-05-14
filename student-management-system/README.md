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
├── config.php              # DB credentials & app constants
├── db.php                  # PDO connection + reusable query helpers
├── index.php               # Student list + search
├── add.php                 # Add student form
├── edit.php                # Edit student form
├── delete.php              # Delete handler (redirect)
├── view.php                # Single student detail page
├── style.css               # All styles
├── database.sql            # DB schema + sample data
├── Dockerfile              # PHP 8.2 + Apache image
├── docker-entrypoint.sh    # Wires $PORT for Render at runtime
├── render.yaml             # Render blueprint (web + MySQL)
└── README.md               # This file
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

## Deployment (Render — one-click)

The repo includes a `render.yaml` blueprint that provisions **both** the PHP web service and a MySQL database automatically.

### Steps

1. Go to [dashboard.render.com](https://dashboard.render.com) → **New** → **Blueprint**
2. Connect your GitHub account and select the `AZEB21/Practice` repo
3. Render detects `render.yaml` and shows a preview of what it will create:
   - `student-management-system` — PHP/Apache web service (Docker)
   - `student-db` — MySQL database (free tier)
4. Click **Apply** — Render builds the Docker image and wires the DB env vars automatically
5. Once deployed, open the web service URL and run the database schema:
   - Go to the **student-db** service → **Shell** tab
   - Paste the contents of `database.sql` and run it

### Environment Variables (auto-wired by render.yaml)

| Variable  | Source                        |
|-----------|-------------------------------|
| `DB_HOST` | Render MySQL host             |
| `DB_PORT` | Render MySQL port             |
| `DB_NAME` | `student_db`                  |
| `DB_USER` | Render MySQL user             |
| `DB_PASS` | Render MySQL password         |

All values are injected at runtime — no manual editing of `config.php` needed.

### Files included for Render

| File | Purpose |
|---|---|
| `Dockerfile` | PHP 8.2 + Apache image |
| `docker-entrypoint.sh` | Wires Render's dynamic `$PORT` into Apache at startup |
| `render.yaml` | Blueprint — provisions web service + MySQL in one click |

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
