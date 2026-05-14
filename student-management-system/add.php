<?php
// add.php - Add a new student
session_start();
require_once __DIR__ . '/db.php';

$errors = [];
$values = ['name' => '', 'email' => '', 'department' => '', 'age' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitise inputs
    $values['name']       = trim($_POST['name']       ?? '');
    $values['email']      = trim($_POST['email']      ?? '');
    $values['department'] = trim($_POST['department'] ?? '');
    $values['age']        = trim($_POST['age']        ?? '');

    // Validate
    if ($values['name'] === '') {
        $errors['name'] = 'Name is required.';
    } elseif (strlen($values['name']) > 100) {
        $errors['name'] = 'Name must be 100 characters or fewer.';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    } elseif (strlen($values['email']) > 100) {
        $errors['email'] = 'Email must be 100 characters or fewer.';
    } elseif (emailExists($values['email'])) {
        $errors['email'] = 'This email is already registered.';
    }

    if ($values['department'] === '') {
        $errors['department'] = 'Department is required.';
    } elseif (strlen($values['department']) > 100) {
        $errors['department'] = 'Department must be 100 characters or fewer.';
    }

    if ($values['age'] === '') {
        $errors['age'] = 'Age is required.';
    } elseif (!ctype_digit($values['age']) || (int)$values['age'] < 1 || (int)$values['age'] > 120) {
        $errors['age'] = 'Age must be a number between 1 and 120.';
    }

    if (empty($errors)) {
        addStudent($values['name'], $values['email'], $values['department'], (int)$values['age']);
        $_SESSION['message']  = 'Student "' . htmlspecialchars($values['name']) . '" added successfully!';
        $_SESSION['msg_type'] = 'success';
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student — <?= APP_NAME ?></title>
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
    <div class="card-title">Add New Student</div>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">Please fix the errors below before submitting.</div>
    <?php endif; ?>

    <form method="POST" action="add.php" novalidate>

      <div class="form-row">
        <div class="form-group">
          <label for="name">Full Name <span style="color:var(--danger)">*</span></label>
          <input
            type="text" id="name" name="name"
            value="<?= htmlspecialchars($values['name']) ?>"
            placeholder="e.g. Jane Doe"
            maxlength="100"
          >
          <?php if (isset($errors['name'])): ?>
            <span class="error-msg"><?= htmlspecialchars($errors['name']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="email">Email Address <span style="color:var(--danger)">*</span></label>
          <input
            type="email" id="email" name="email"
            value="<?= htmlspecialchars($values['email']) ?>"
            placeholder="e.g. jane@example.com"
            maxlength="100"
          >
          <?php if (isset($errors['email'])): ?>
            <span class="error-msg"><?= htmlspecialchars($errors['email']) ?></span>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="department">Department <span style="color:var(--danger)">*</span></label>
          <input
            type="text" id="department" name="department"
            value="<?= htmlspecialchars($values['department']) ?>"
            placeholder="e.g. Computer Science"
            maxlength="100"
          >
          <?php if (isset($errors['department'])): ?>
            <span class="error-msg"><?= htmlspecialchars($errors['department']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="age">Age <span style="color:var(--danger)">*</span></label>
          <input
            type="number" id="age" name="age"
            value="<?= htmlspecialchars($values['age']) ?>"
            placeholder="e.g. 20"
            min="1" max="120"
          >
          <?php if (isset($errors['age'])): ?>
            <span class="error-msg"><?= htmlspecialchars($errors['age']) ?></span>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Student</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </div>

    </form>
  </div>
</div>

</body>
</html>
