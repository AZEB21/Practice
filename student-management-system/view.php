<?php
// view.php - View a single student's details
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($student['name']) ?> — <?= APP_NAME ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <h1>🎓 <?= APP_NAME ?></h1>
  <nav>
    <a href="index.php">All Students</a>
    <a href="add.php">+ Add Student</a>
  </nav>
</header>

<div class="container">
  <div class="card" style="max-width:640px;margin:0 auto;">
    <div class="card-title">Student Details</div>

    <div class="detail-grid">
      <div class="detail-item">
        <label>Full Name</label>
        <span><?= htmlspecialchars($student['name']) ?></span>
      </div>
      <div class="detail-item">
        <label>Email Address</label>
        <span><?= htmlspecialchars($student['email']) ?></span>
      </div>
      <div class="detail-item">
        <label>Department</label>
        <span><span class="badge"><?= htmlspecialchars($student['department']) ?></span></span>
      </div>
      <div class="detail-item">
        <label>Age</label>
        <span><?= (int)$student['age'] ?> years old</span>
      </div>
      <div class="detail-item">
        <label>Student ID</label>
        <span>#<?= (int)$student['id'] ?></span>
      </div>
      <div class="detail-item">
        <label>Registered On</label>
        <span><?= date('F j, Y \a\t g:i A', strtotime($student['created_at'])) ?></span>
      </div>
    </div>

    <div class="form-actions" style="margin-top:1.75rem;">
      <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-primary">Edit</a>
      <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger"
         onclick="return confirm('Delete <?= htmlspecialchars(addslashes($student['name'])) ?>?')">
        Delete
      </a>
      <a href="index.php" class="btn btn-secondary">← Back to List</a>
    </div>
  </div>
</div>

</body>
</html>
