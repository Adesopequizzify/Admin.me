<?php
// Check if user is not logged in, redirect to login page
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

// Check if score ID is provided
if (!isset($_GET['id'])) {
  header("Location: scores.php");
  exit();
}

// Get the score ID from the query parameter
$scoreId = $_GET['id'];

// Include the database connection file
require_once 'database.php';

// Retrieve the score data for the given ID
$sql = "SELECT scores.id, users.name, scores.score FROM scores JOIN users ON scores.user_id = users.id WHERE scores.id = $scoreId";
$result = $conn->query($sql);

// Check if the query was successful and score data exists
if ($result === false || $result->num_rows === 0) {
  header("Location: scores.php");
  exit();
}

// Fetch the score data
$scoreData = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate the submitted score
  $scoreIncrement = $_POST['score_increment'];
  if (!is_numeric($scoreIncrement) || $scoreIncrement < 0) {
    $error = "Invalid score increment value. Please enter a positive number.";
  } else {
    // Update the score in the database by incrementing the existing score
    $newScore = $scoreData['score'] + $scoreIncrement;
    $updateSql = "UPDATE scores SET score = $newScore WHERE id = $scoreId";
    if ($conn->query($updateSql) === true) {
      // Score updated successfully, redirect back to scores page
      header("Location: scores.php");
      exit();
    } else {
      $error = "Error updating score: " . $conn->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Update Score</title>
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
    .form-container {
      margin-top: 30px;
    }
    .form-container input[type="number"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ddd;
    }
    .error-message {
      color: red;
      margin-top: 10px;
      text-align: center;
    }
    .text-center {
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
    .back-button {
      margin-top: 20px;
      text-align: center;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
      font-size: 14px;
      padding: 10px 20px;
    }
    .btn-secondary:hover {
      background-color: #52585e;
      border-color: #52585e;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Update Score</h1>
    <div class="form-container">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $scoreId; ?>">
        <div class="mb-3">
          <label for="score" class="form-label">Current Score:</label>
          <input type="text" id="score" name="score" value="<?php echo $scoreData['score']; ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="score_increment" class="form-label">Score Increment:</label>
          <input type="number" id="score_increment" name="score_increment" min="0" required>
        </div>
        <?php if (isset($error)): ?>
          <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="text-center">
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add to Score</button>
        </div>
      </form>
    </div>
    <div class="back-button">
      <a href="scores.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Scores</a>
    </div>
  </div>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
