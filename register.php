<?php
require_once "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate inputs (optional, you can add more validations if needed)
    if (empty($name) || empty($email) || empty($password)) {
        echo "Please fill in all the required fields.";
        exit;
    }

    // Prepare and execute the SQL statement to insert the data into the database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $name;
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
