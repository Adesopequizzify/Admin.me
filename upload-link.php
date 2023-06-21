<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

require_once "database.php";

// Define variables and set to empty values
$title = $description = $link = "";
$titleErr = $linkErr = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate input fields
  if (empty($_POST["title"])) {
    $titleErr = "Title is required";
  } else {
    $title = $_POST["title"];
  }

  if (empty($_POST["link"])) {
    $linkErr = "Link is required";
  } else {
    $link = $_POST["link"];
  }
$current_time = date('Y-m-d H:i:s');

  // Insert the quiz link into the database if there are no errors
  if (empty($titleErr) && empty($linkErr)) {
    $sql = "INSERT INTO quiz_links (title, link, time) VALUES ('$title', '$link', '$current_time')";
    if (mysqli_query($conn, $sql)) {
      $successMessage = "Quiz link uploaded successfully";
      $title = $description = $link = ""; // Reset the form fields
    } else {
      $errorMessage = "Error: " . mysqli_error($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Upload Quiz Link</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css">
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
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      height: 40px;
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
    .error {
      color: red;
    }
    .success {
      color: green;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Upload Quiz Link</h5>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
            <span class="error"><?php echo $titleErr; ?></span>
          </div>
          <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" name="link" class="form-control" value="<?php echo $link; ?>">
            <span class="error"><?php echo $linkErr; ?></span>
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <?php
        if (isset($successMessage)) {
          echo '<div class="success">' . $successMessage . '</div>';
        } elseif (isset($errorMessage)) {
          echo '<div class="error">' . $errorMessage . '</div>';
        }
        ?>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="footer-text">Created by <a href="https://adesope.quizzify.com.ng" class="portfolio-link">Adesope Muiz</a></p>
    </div>
  </footer>

  <!-- Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
</body>
</html>
