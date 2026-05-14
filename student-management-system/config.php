<?php
// config.php - Application configuration
// All values can be overridden via environment variables (Render dashboard).

// Set DB_DRIVER to 'pgsql' for PostgreSQL (Render free tier)
// or 'mysql' for MySQL (XAMPP local). Defaults to pgsql.
define('DB_DRIVER',   getenv('DB_DRIVER')   ?: 'pgsql');

define('DB_HOST',     getenv('DB_HOST')     ?: 'localhost');
define('DB_PORT',     getenv('DB_PORT')     ?: (DB_DRIVER === 'pgsql' ? '5432' : '3306'));
define('DB_NAME',     getenv('DB_NAME')     ?: 'student_db');
define('DB_USER',     getenv('DB_USER')     ?: 'root');
define('DB_PASS',     getenv('DB_PASS')     ?: '');

define('APP_NAME',    'Student Management System');
define('APP_VERSION', '1.0.0');
