<?php
require_once 'database.php';

// Fetch scores and names from the database
$query = "SELECT scores.score, users.name FROM scores
          INNER JOIN users ON scores.user_id = users.id
          ORDER BY scores.score DESC";
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
  echo'
  <html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glassmorphism-ui/dist/glassmorphism-ui.min.css">
    <style>
      .leaderboard-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
      }

      .leaderboard-heading {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
      }

      .leaderboard-table {
        width: 100%;
        border-collapse: collapse;
      }

      .leaderboard-table th,
      .leaderboard-table td {
        padding: 10px;
        border: 1px solid #ddd;
      }

      .leaderboard-table th {
        background-color: #f5f5f5;
        font-weight: bold;
      }

      .motivating-text {
        font-size: 18px;
        margin-top: 20px;
      }

      .motivating-text i {
        font-size: 24px;
        vertical-align: middle;
        margin-right: 5px;
      }
    </style>
  </head>
  <body>
    <div class="leaderboard-container">
      <h2 class="leaderboard-heading">Leaderboard</h2>
      <table class="leaderboard-table">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody>';

  $rank = 1;
  // Fetch and display each record
  while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $score = $row['score'];

    echo "<tr>
            <td>$rank</td>
            <td>$name</td>
            <td>$score</td>
          </tr>";

    $rank++;
  }

  echo '</tbody></table>
        <p class="motivating-text">
          <i class="bi bi-trophy-fill"></i>
          Keep up the good work and strive for the top!
        </p>
      </div>
    </body>
  </html>';

} else {
  echo 'No scores found.';
}

$conn->close();
?>
