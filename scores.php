<?php
// Check if user is not logged in, redirect to login page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
  exit();
}

// Include the database connection file
require_once 'database.php';

// Retrieve users' scores from the scores table
$sql = "SELECT scores.id, users.name, scores.score, scores.date FROM scores JOIN users ON scores.user_id = users.id";
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
  <title>Users' Scores</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <style>
    .container {
      max-width: 800px;
      margin-top: 50px;
    }
    .table-container {
      margin-top: 30px;
    }
    .table-container table {
      width: 100%;
    }
    .table-container th,
    .table-container td {
      padding: 10px;
      text-align: center;
    }
    .action-button {
      padding: 5px 10px;
    }
    .back-button {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">Users' Scores</h1>
    <div class="table-container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Score</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($scores as $score): ?>
            <tr>
              <td><?php echo $score['name']; ?></td>
              <td><?php echo $score['score']; ?></td>
              <td><?php echo $score['date']; ?></td>
              <td>
                <a href="update_score.php?id=<?php echo $score['id']; ?>" class="btn btn-primary action-button">
                  <i class="fas fa-pencil-alt"></i> Update
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="text-center back-button">
      <a href="dashboard.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
      </a>
    </div>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
