<?php
// delete.php - Delete a student (GET with confirmation already done in JS)
session_start();
require_once __DIR__ . '/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$student = getStudentById($id);
if (!$student) {
    $_SESSION['message']  = 'Student not found.';
    $_SESSION['msg_type'] = 'error';
    header('Location: index.php');
    exit;
}

$deleted = deleteStudent($id);

if ($deleted) {
    $_SESSION['message']  = 'Student "' . htmlspecialchars($student['name']) . '" deleted successfully.';
    $_SESSION['msg_type'] = 'success';
} else {
    $_SESSION['message']  = 'Could not delete the student. Please try again.';
    $_SESSION['msg_type'] = 'error';
}

header('Location: index.php');
exit;
