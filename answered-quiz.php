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
  <title>You've Answered this Quiz</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glassmorphism-ui/dist/glassmorphism-ui.min.css">
  <style>
    .answered-quiz-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .answered-quiz-card {
      max-width: 400px;
      padding: 2rem;
      text-align: center;
    }

    .answered-quiz-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      color: #28a745;
    }

    .answered-quiz-message {
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .answered-quiz-link {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }

    .answered-quiz-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="answered-quiz-container">
    <div class="card p-4 rounded-lg bg-white shadow-lg glass-effect answered-quiz-card">
      <i class="bi bi-check-circle-fill answered-quiz-icon"></i>
      <h2 class="answered-quiz-message">Congratulations, <?php echo $_SESSION['username']; ?>!</h2>
      <p>You have successfully answered this quiz.</p>
      <p>Thank you for participating!</p>
      <a href="dashboard.php" class="answered-quiz-link">Back to Home</a>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
