<?php
// db.php - Central database connection using PDO

require_once __DIR__ . '/config.php';

function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT
             . ';dbname=' . DB_NAME . ';charset=utf8mb4';

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Show a friendly error; never expose credentials
            die('<div style="font-family:sans-serif;color:#c0392b;padding:2rem;">
                    <h2>Database Connection Failed</h2>
                    <p>Could not connect to the database. Please check your configuration.</p>
                    <pre>' . htmlspecialchars($e->getMessage()) . '</pre>
                 </div>');
        }
    }

    return $pdo;
}

// ─── Reusable query helpers ───────────────────────────────────────────────────

/**
 * Fetch all students, optionally filtered by a search term.
 */
function getAllStudents(string $search = ''): array {
    $db = getDB();
    if ($search !== '') {
        $stmt = $db->prepare(
            'SELECT * FROM students
              WHERE name  LIKE :search
                 OR email LIKE :search
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
    $stmt = getDB()->prepare(
        'INSERT INTO students (name, email, department, age)
         VALUES (:name, :email, :department, :age)'
    );
    $stmt->execute([
        ':name'       => $name,
        ':email'      => $email,
        ':department' => $department,
        ':age'        => $age,
    ]);
    return (int) getDB()->lastInsertId();
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
        'SELECT COUNT(*) FROM students WHERE email = :email AND id != :id'
    );
    $stmt->execute([':email' => $email, ':id' => $excludeId]);
    return (int) $stmt->fetchColumn() > 0;
}
