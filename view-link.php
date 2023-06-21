<?php
// Start the session
session_start();

// Check if the admin session is not set
if (!isset($_SESSION['admin'])) {
    // Redirect to index.php
    header("Location: index.php");
    exit;
}

// Include the database connection file
require_once "database.php";

// Delete quiz link
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM quiz_links WHERE id = $id";
    // Execute the deletion query
    if ($conn->query($sql) === TRUE) {
        echo "Quiz link deleted successfully";
    } else {
        echo "Error deleting quiz link: " . $conn->error;
    }
}

// Retrieve quiz links from the database
$sql = "SELECT * FROM quiz_links";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Links</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quiz Links</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["link"] . "</td>";
                        echo "<td>" . $row["time"] . "</td>";
                        echo "<td><a class='btn btn-danger' href=\"?delete=" . $row["id"] . "\">Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No quiz links found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
