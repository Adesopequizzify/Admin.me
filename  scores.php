<?php
// Check if user is not logged in, redirect to login page
session_start();
if (!isset($_SESSION['Name'])) {
  header("Location: index.php");
  exit();
}

$Name = $_SESSION['Name']; // Assign the value to $Name

// Include the database connection file
require_once 'database.php';

// Retrieve user's scores from the scores table
$sql = "SELECT scores.date, scores.score FROM scores
        INNER JOIN users ON scores.user_id = users.id
        WHERE users.Name = '$Name'";

$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
  echo "Error retrieving scores data: " . $conn->error;
  exit();
}

// Fetch the data from the result set
$scores = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Check Scores</title>
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
    .table-container {
      margin-top: 20px;
    }
    .table-container table {
      width: 100%;
    }
    .table-container th,
    .table-container td {
      padding: 10px;
    }
    .table-container th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    .table-container td {
      background-color: #ffffff;
    }
    .table-container td button {
      padding: 5px 10px;
    }
    .btn-primary {
      background-color: #17a2b8;
      border-color: #17a2b8;
      font-size: 12px;
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
    .back-button {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="title is-1 has-text-centered">Check Scores</h1>
    <div class="table-container">
      <table class="table is-striped is-fullwidth">
        <thead>
          <tr>
            <th>Date</th>
            <th>Score</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($scores as $score): ?>
            <tr>
              <td><?php echo $score['date']; ?></td>
              <td><?php echo $score['score']; ?></td>
              <td>
                <button class="button is-primary">
                  <i class="fas fa-sync"></i> Update
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="back-button">
      <a href="dashboard.php" class="button is-info"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
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
