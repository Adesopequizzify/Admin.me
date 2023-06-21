<?php
// Replace the database credentials with your own
$servername = "pld110.truehost.cloud";
$username = "quizwift_Adesope";
$password = "Adeniyi20#";
$dbname = "quizwift_quizzify";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
