<?php
// index.php - List all students with search
session_start();
require_once __DIR__ . '/db.php';

$search  = trim($_GET['search'] ?? '');

// Grab flash message set by other pages
$message = $_SESSION['message'] ?? '';
$msgType = $_SESSION['msg_type'] ?? 'success';
unset($_SESSION['message'], $_SESSION['msg_type']);

$students = getAllStudents($search);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students — <?= APP_NAME ?></title>
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

  <?php if ($message): ?>
    <div class="alert alert-<?= htmlspecialchars($msgType) ?>">
      <?= htmlspecialchars($message) ?>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="page-header">
      <h2>Student List
        <?php if ($search): ?>
          <span style="font-size:.85rem;font-weight:400;color:var(--muted)">
            — results for "<?= htmlspecialchars($search) ?>"
          </span>
        <?php endif; ?>
      </h2>
      <a href="add.php" class="btn btn-primary">+ Add Student</a>
    </div>

    <!-- Search -->
    <form method="GET" action="index.php" class="search-bar">
      <input
        type="text"
        name="search"
        placeholder="Search by name or email…"
        value="<?= htmlspecialchars($search) ?>"
      >
      <button type="submit" class="btn btn-primary">Search</button>
      <?php if ($search): ?>
        <a href="index.php" class="btn btn-secondary">Clear</a>
      <?php endif; ?>
    </form>

    <!-- Table -->
    <?php if (empty($students)): ?>
      <div class="empty-state">
        <p>No students found<?= $search ? ' matching your search' : '' ?>.</p>
        <a href="add.php" class="btn btn-primary">Add the first student</a>
      </div>
    <?php else: ?>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Department</th>
              <th>Age</th>
              <th>Registered</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $i => $s): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= htmlspecialchars($s['name']) ?></td>
              <td><?= htmlspecialchars($s['email']) ?></td>
              <td><span class="badge"><?= htmlspecialchars($s['department']) ?></span></td>
              <td><?= (int)$s['age'] ?></td>
              <td><?= date('M j, Y', strtotime($s['created_at'])) ?></td>
              <td>
                <div class="actions">
                  <a href="view.php?id=<?= $s['id'] ?>"   class="btn btn-secondary btn-sm">View</a>
                  <a href="edit.php?id=<?= $s['id'] ?>"   class="btn btn-primary   btn-sm">Edit</a>
                  <a href="delete.php?id=<?= $s['id'] ?>" class="btn btn-danger     btn-sm"
                     onclick="return confirm('Delete <?= htmlspecialchars(addslashes($s['name'])) ?>?')">
                    Delete
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p style="margin-top:.75rem;font-size:.85rem;color:var(--muted)">
        <?= count($students) ?> student<?= count($students) !== 1 ? 's' : '' ?> found.
      </p>
    <?php endif; ?>
  </div>

</div>
</body>
</html>
