<?php
session_start();
require_once "database.php";

// Check if the user is already logged in, redirect to the dashboard
if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
  exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the login credentials from the form
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Perform the login validation (replace with your own logic)
  $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    // Get the user's name from the result set
    $row = $result->fetch_assoc();
    $name = $row['name'];

    // Set the session variables
    $_SESSION['username'] = $name;

    // Redirect to the dashboard or any other desired page after successful login
    header("Location: dashboard.php");
    exit();
  } else {
    // Display an error message for invalid credentials
    $error_message = "Invalid email or password.";
  }

  $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Quiz Login</title>
  <style>
    body {
      background-color: #f7f7f7;
    }
    .container {
      max-width: 400px;
      margin: 100px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #663399;
      text-align: center;
      margin-bottom: 30px;
    }
    .form-group label {
      color: #333;
      font-weight: 600;
    }
    .btn-purple {
      background-color: #663399;
      color: #fff;
      border: none;
    }
    .btn-purple:hover {
      background-color: #531e91;
    }
    .footer {
      text-align: center;
      margin-top: 30px;
    }
    .footer a {
      color: #333;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Quizzify| Login</h2>
    <?php if (isset($error_message)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error_message; ?>
      </div>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fa fa-user"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="email" name="email" required>
        </div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
      </div>
      <button type="submit" class="btn btn-purple btn-block">Login</button>
    </form>
  </div>

  <footer class="footer">
    Created by <a href="https://adesope.quizzify.com.ng">Adesope Muiz</a>
  </footer>

 <script src="https://kit.fontawesome.com/5d8166a315.js" crossorigin="anonymous"></script>
</body>
</html>
