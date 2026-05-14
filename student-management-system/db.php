<?php
// db.php - Central database connection using PDO
// Supports both PostgreSQL (Render) and MySQL (local XAMPP).

require_once __DIR__ . '/config.php';

function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        // Build DSN based on driver
        if (DB_DRIVER === 'pgsql') {
            $dsn = 'pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
        } else {
            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT
                 . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        }

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;color:#c0392b;padding:2rem;">
                    <h2>Database Connection Failed</h2>
                    <p>Could not connect to the database. Please check your configuration.</p>
                    <pre>' . htmlspecialchars($e->getMessage()) . '</pre>
                 </div>');
        }

        // Auto-create the students table if it doesn't exist yet
        migrateDB($pdo);
    }

    return $pdo;
}

/**
 * Create the students table if it doesn't already exist.
 * Runs once on first connection — safe to call on every request.
 */
function migrateDB(PDO $pdo): void {
    if (DB_DRIVER === 'pgsql') {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS students (
                id         SERIAL       PRIMARY KEY,
                name       VARCHAR(100) NOT NULL,
                email      VARCHAR(100) NOT NULL UNIQUE,
                department VARCHAR(100) NOT NULL,
                age        INT          NOT NULL,
                created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
            )
        ");
    } else {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS students (
                id         INT          NOT NULL AUTO_INCREMENT,
                name       VARCHAR(100) NOT NULL,
                email      VARCHAR(100) NOT NULL UNIQUE,
                department VARCHAR(100) NOT NULL,
                age        INT          NOT NULL,
                created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }
}

// ─── Reusable query helpers ───────────────────────────────────────────────────

/**
 * Fetch all students, optionally filtered by a search term.
 */
function getAllStudents(string $search = ''): array {
    $db = getDB();
    if ($search !== '') {
        // ILIKE is Postgres; LIKE works for both but is case-sensitive in Postgres.
        // Use LOWER() for portable case-insensitive search.
        $stmt = $db->prepare(
            'SELECT * FROM students
              WHERE LOWER(name)  LIKE LOWER(:search)
                 OR LOWER(email) LIKE LOWER(:search)
              ORDER BY created_at DESC'
        );
        $stmt->execute([':search' => '%' . $search . '%']);
    } else {
        $stmt = $db->query('SELECT * FROM students ORDER BY created_at DESC');
    }
    return $stmt->fetchAll();
}

/**
 * Fetch a single student by ID. Returns false if not found.
 */
function getStudentById(int $id): array|false {
    $stmt = getDB()->prepare('SELECT * FROM students WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

/**
 * Insert a new student. Returns the new row's ID.
 */
function addStudent(string $name, string $email, string $department, int $age): int {
    $db = getDB();

    if (DB_DRIVER === 'pgsql') {
        // PostgreSQL uses RETURNING to get the inserted ID
        $stmt = $db->prepare(
            'INSERT INTO students (name, email, department, age)
             VALUES (:name, :email, :department, :age)
             RETURNING id'
        );
        $stmt->execute([
            ':name'       => $name,
            ':email'      => $email,
            ':department' => $department,
            ':age'        => $age,
        ]);
        return (int) $stmt->fetchColumn();
    } else {
        $stmt = $db->prepare(
            'INSERT INTO students (name, email, department, age)
             VALUES (:name, :email, :department, :age)'
        );
        $stmt->execute([
            ':name'       => $name,
            ':email'      => $email,
            ':department' => $department,
            ':age'        => $age,
        ]);
        return (int) $db->lastInsertId();
    }
}

/**
 * Update an existing student. Returns number of affected rows.
 */
function updateStudent(int $id, string $name, string $email, string $department, int $age): int {
    $stmt = getDB()->prepare(
        'UPDATE students
            SET name = :name, email = :email, department = :department, age = :age
          WHERE id = :id'
    );
    $stmt->execute([
        ':id'         => $id,
        ':name'       => $name,
        ':email'      => $email,
        ':department' => $department,
        ':age'        => $age,
    ]);
    return $stmt->rowCount();
}

/**
 * Delete a student by ID. Returns number of affected rows.
 */
function deleteStudent(int $id): int {
    $stmt = getDB()->prepare('DELETE FROM students WHERE id = :id');
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}

/**
 * Check whether an email is already taken (optionally excluding a given ID).
 */
function emailExists(string $email, int $excludeId = 0): bool {
    $stmt = getDB()->prepare(
        'SELECT COUNT(*) FROM students WHERE LOWER(email) = LOWER(:email) AND id != :id'
    );
    $stmt->execute([':email' => $email, ':id' => $excludeId]);
    return (int) $stmt->fetchColumn() > 0;
}
