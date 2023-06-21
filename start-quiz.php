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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Start Quiz</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glassmorphism-ui/dist/glassmorphism-ui.min.css">
  <style>
    .start-quiz-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .start-quiz-card {
      max-width: 400px;
      padding: 2rem;
      text-align: center;
    }

    .start-quiz-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      color: #007bff;
    }

    .start-quiz-message {
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .start-quiz-button {
      padding: 1rem 2rem;
      font-size: 1.2rem;
      font-weight: bold;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
      border: none;
      transition: all 0.3s ease;
    }

    .start-quiz-button:hover {
      background-color: #0056b3;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="start-quiz-container">
    <div class="card p-4 rounded-lg bg-white shadow-lg glass-effect start-quiz-card">
      <i class="bi bi-play-fill start-quiz-icon"></i>
      <h2 class="start-quiz-message">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
      <p>Click the button below to start the quiz.</p>
      <a class="start-quiz-button" href="fetch-quiz.php"><i class="bi bi-play-fill mr-2"></i>Start Quiz</a>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
