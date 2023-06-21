<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>That's All</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glassmorphism-ui/dist/glassmorphism-ui.min.css">
  <style>
    .thats-all-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .thats-all-card {
      max-width: 400px;
      padding: 2rem;
      text-align: center;
    }

    .thats-all-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      color: #dc3545;
    }

    .thats-all-message {
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .thats-all-link {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }

    .thats-all-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="thats-all-container">
    <div class="card p-4 rounded-lg bg-white shadow-lg glass-effect thats-all-card">
      <i class="bi bi-info-circle-fill thats-all-icon"></i>
      <h2 class="thats-all-message">Sorry, <?php echo $_SESSION['username']; ?>!</h2>
      <p>There are no more quizzes available at the moment.</p>
      <p>Stay tuned for future quizzes!</p>
      <a href="dashboard.php" class="thats-all-link">Back to Home</a>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
