<?php
// Check if user is not logged in, redirect to login page
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Get the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Quiz Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* ... CSS styles ... */
    body {
      background-color: #f2f2f2;
    }
    .container {
      margin-top: 20px;
    }
    .card {
      border: none;
      border-radius: 10px;
      padding: 10px;
      background-color: #ffffff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-title {
      margin-top: 10px;
      margin-bottom: 20px;
      font-size: 18px;
      color: #333333;
    }
    .card-body {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .card-icon {
      font-size: 24px;
      color: #333333;
      margin-bottom: 20px;
    }
    .btn-primary {
      background-color: #17a2b8;
      border-color: #17a2b8;
      font-size: 12px;
      padding: 5px 10px;
    }
    .btn-primary:hover {
      background-color: #138496;
      border-color: #138496;
    }
    .footer {
      background-color: #f2f2f2;
      padding: 20px;
      text-align: center;
    }
    .footer a {
      color: #333333;
    }
    .footer a:hover {
      color: #138496;
    }
    .footer-text {
      font-size: 14px;
      margin-bottom: 5px;
    }
    .portfolio-link {
      color: #333333;
      font-weight: bold;
    }
    .portfolio-link:hover {
      color: #138496;
      text-decoration: none;
    }
    .welcome-message {
  text-align: center;
  margin-bottom: 20px;
}

    
    .container {
  margin-top: 20px;
  max-width: 600px;
}

.col-md-4 {
  margin-bottom: 20px;
}

    }
    .welcome-message span {
      font-size: 16px;
      font-weight: bold;
    }
    .logout-button {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="welcome-message">
      <span>Welcome, <?php echo $username; ?></span>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Start Quiz</h5>
            <i class="fas fa-clipboard-list card-icon"></i>
            <a href="start-quiz.php" class="btn btn-primary">Start</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Check Scores</h5>
            <i class="fas fa-chart-bar card-icon"></i>
            <a href="check-scores.php" class="btn btn-primary">Check</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Leaderboard</h5>
            <i class="fas fa-trophy card-icon"></i>
            <a href="leaderboard.php" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>
    </div>
    <div class="logout-button">
      <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="footer-text">Created by <a href="https://adesope.quizzify.com.ng" class="portfolio-link">Adesope Muiz</a></p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

