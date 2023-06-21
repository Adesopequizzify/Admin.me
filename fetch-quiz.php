<?php
session_start();
require_once 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}

// Fetch a random quiz link from the database
$link = fetchQuizLink();

// Check if a link is available
if ($link) {
  // Redirect to the quiz link
  header("Location: " . $link);
  exit;
} else {
  // No links available, redirect to the "thats-all.php" page
  header("Location: thats-all.php");
  exit;
}

// Function to fetch a random quiz link from the database
function fetchQuizLink() {
  // Connect to the database (replace with your database credentials)
  $conn = mysqli_connect("pld110.truehost.cloud", "quizwift_Adesope", "Adeniyi20#", "quizwift_quizzify");
  
  // Check if the connection was successful
  if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  
  // Query to fetch a random quiz link
  $query = "SELECT link FROM quiz_links ORDER BY RAND() LIMIT 1";
  
  // Execute the query
  $result = mysqli_query($conn, $query);
  
  // Check if any rows were returned
  if (mysqli_num_rows($result) > 0) {
    // Fetch the link from the first row
    $row = mysqli_fetch_assoc($result);
    $link = $row['link'];
    
    // Close the database connection
    mysqli_close($conn);
    
    return $link;
  }
  
  // Close the database connection
  mysqli_close($conn);
  
  return null;
}
