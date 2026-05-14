-- ============================================================
-- Student Management System — Database Setup
-- Supports both PostgreSQL (Render) and MySQL (local XAMPP).
-- ============================================================

-- ── PostgreSQL (Render free tier) ─────────────────────────
-- Run this block if your database is PostgreSQL:

DROP TABLE IF EXISTS students;

CREATE TABLE students (
  id         SERIAL       PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(100) NOT NULL UNIQUE,
  department VARCHAR(100) NOT NULL,
  age        INT          NOT NULL,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_students_email ON students (LOWER(email));
CREATE INDEX IF NOT EXISTS idx_students_name  ON students (LOWER(name));

-- Sample data (optional — remove in production)
INSERT INTO students (name, email, department, age) VALUES
  ('Alice Johnson', 'alice@example.com', 'Computer Science',       21),
  ('Bob Martinez',  'bob@example.com',   'Electrical Engineering', 23),
  ('Carol White',   'carol@example.com', 'Mathematics',            20),
  ('David Lee',     'david@example.com', 'Physics',                22),
  ('Eva Brown',     'eva@example.com',   'Computer Science',       19);


-- ── MySQL (local XAMPP) ────────────────────────────────────
-- Run this block instead if your database is MySQL:
--
-- CREATE DATABASE IF NOT EXISTS student_db
--   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE student_db;
--
-- DROP TABLE IF EXISTS students;
--
-- CREATE TABLE students (
--   id         INT          NOT NULL AUTO_INCREMENT,
--   name       VARCHAR(100) NOT NULL,
--   email      VARCHAR(100) NOT NULL UNIQUE,
--   department VARCHAR(100) NOT NULL,
--   age        INT          NOT NULL,
--   created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (id),
--   INDEX idx_email (email),
--   INDEX idx_name  (name)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- INSERT INTO students (name, email, department, age) VALUES
--   ('Alice Johnson', 'alice@example.com', 'Computer Science',       21),
--   ('Bob Martinez',  'bob@example.com',   'Electrical Engineering', 23),
--   ('Carol White',   'carol@example.com', 'Mathematics',            20),
--   ('David Lee',     'david@example.com', 'Physics',                22),
--   ('Eva Brown',     'eva@example.com',   'Computer Science',       19);
