-- ============================================================
-- Student Management System — Database Setup
-- Run this file once to create the database and table.
-- ============================================================

-- Create database (skip if it already exists)
CREATE DATABASE IF NOT EXISTS student_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE student_db;

-- Drop table if re-running setup
DROP TABLE IF EXISTS students;

-- Create students table
CREATE TABLE students (
  id         INT          NOT NULL AUTO_INCREMENT,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(100) NOT NULL UNIQUE,
  department VARCHAR(100) NOT NULL,
  age        INT          NOT NULL,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_email (email),
  INDEX idx_name  (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Sample data (optional — remove in production) ──────────────────────────
INSERT INTO students (name, email, department, age) VALUES
  ('Alice Johnson',  'alice@example.com',  'Computer Science',    21),
  ('Bob Martinez',   'bob@example.com',    'Electrical Engineering', 23),
  ('Carol White',    'carol@example.com',  'Mathematics',         20),
  ('David Lee',      'david@example.com',  'Physics',             22),
  ('Eva Brown',      'eva@example.com',    'Computer Science',    19);
