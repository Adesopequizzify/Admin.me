<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Admin credentials
    $adminEmail = "admin@quizzify.com.ng";
    $adminPassword = "1234muiz";

    // Get the submitted credentials
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the credentials
    if ($email === $adminEmail && $password === $adminPassword) {
        // Credentials are valid, store admin status and name in session
        $_SESSION["admin"] = true;
        $_SESSION["Name"] = "Adesope";
        header("Location: admin_page.php");
        exit;
    } else {
        // Invalid credentials, display an error message
        $error = "Invalid credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Admin Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
      <?php endif; ?>
      <div class="input-group">
        <input type="submit" value="Login">
      </div>
    </form>
  </div>
</body>
</html>
