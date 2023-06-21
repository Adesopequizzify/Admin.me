<?php
// Check if user is not logged in, redirect to login page
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Include the database connection file
require_once 'database.php';

// Retrieve the user's score
$username = $_SESSION['username'];
$sql = "SELECT * FROM scores JOIN users ON scores.user_id = users.id WHERE users.name = '$username' ORDER BY scores.date DESC LIMIT 1";
$result = $conn->query($sql);

// Fetch the score data
if ($result && $result->num_rows > 0) {
  $scoreData = $result->fetch_assoc();
  $score = $scoreData['score'];
  $date = $scoreData['date'];
} else {
  $score = "N/A";
  $date = "N/A";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Check Scores</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 400px;
      margin-top: 50px;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      margin-bottom: 30px;
    }
    .score-container {
      text-align: center;
      margin-bottom: 20px;
    }
    .score-container p {
      font-size: 24px;
      margin-bottom: 5px;
    }
    .score-container small {
      color: #6c757d;
    }
    .refresh-button {
      text-align: center;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      font-size: 14px;
      padding: 10px 20px;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Check Scores</h1>
    <div class="score-container">
      <p>Your Score:</p>
      <p><?php echo $score; ?></p>
      <small>Last Updated: <?php echo $date; ?></small>
    </div>
    <div class="refresh-button">
      <a href="check_scores.php" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
    </div>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
