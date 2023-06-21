<?php
// Check if user is not logged in, redirect to login page
session_start();
if (!isset($_SESSION['Name'])) {
  header("Location: index.php");
  exit();
}

$Name = $_SESSION['Name']; // Assign the value to $Name

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Quiz Dashboard</title>
  <!-- Bulma CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      background-color: #f2f2f2;
    }
    .container {
      margin-top: 20px;
    }
    .card {
      border-radius: 10px;
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
    .logout-button {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="title is-1 has-text-centered">Welcome, <?php echo $Name; ?></h1>
    <div class="columns is-centered">
      <div class="column is-one-third">
        <div class="card">
          <div class="card-content has-text-centered">
            <h5 class="title is-5">Upload Link</h5>
            <i class="fa fa-upload card-icon"></i>
            <a href="upload-link.php" class="button is-primary">Upload</a>
          </div>
        </div>
      </div>
      <div class="column is-one-third">
        <div class="card">
          <div class="card-content has-text-centered">
            <h5 class="title is-5">Update Leaderboard</h5>
            <i class="fa fa-list-alt card-icon"></i>
            <a href="update-leaderboard.php" class="button is-primary">Update</a>
          </div>
        </div>
      </div>
      <div class="column is-one-third">
        <div class="card">
          <div class="card-content has-text-centered">
            <h5 class="title is-5">View Link</h5>
            <i class="fa fa-eye card-icon"></i>
            <a href="view-link.php" class="button is-primary">View</a>
          </div>
        </div>
      </div>
    </div>
    <div class="columns is-centered">
      <div class="column is-one-third">
        <div class="card">
          <div class="card-content has-text-centered">
            <h5 class="title is-5">Members</h5>
            <i class="fa fa-users card-icon"></i>
            <a href="members.php" class="button is-primary">View</a>
          </div>
        </div>
      </div>
      <div class="column is-one-third">
        <div class="card">
          <div class="card-content has-text-centered">
            <h5 class="title is-5">Update Scores</h5>
            <i class="fa fa-chart-bar card-icon"></i>
            <a href="scores.php" class="button is-primary">Update</a>
          </div>
        </div>
      </div>
    </div>
    <div class="logout-button">
      <a href="logout.php" class="button is-danger"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="footer-text">Created by <a href="https://adesope.quizzify.com.ng" class="portfolio-link">Adesope Muiz</a></p>
    </div>
  </footer>

  <!-- Bulma JavaScript -->
  <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
</body>
</html>
