<?php
// Start session
ob_start();
require_once "functions/db.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $author = isset($_POST['author']) ? trim($_POST['author']) : 'anonymous';
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    // Get current date and time
    $date = date('Y-m-d H:i:s'); // Format: 2024-09-17 14:20:30

    // Ensure required fields are not empty
    if (!empty($title) && !empty($content)) {
        // Prepare the SQL query to insert data into the database
        $query = "INSERT INTO posts (author, title, content, date) VALUES (?, ?, ?, ?)";
        
        // Use prepared statements to avoid SQL injection
        if ($stmt = $connection->prepare($query)) {
            $stmt->bind_param("ssss", $author, $title, $content, $date);

            // Execute the query and check if successful
            if ($stmt->execute()) {
                echo "Post successfully saved!";
            } else {
                echo "Error: Could not save the post.";
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

// Close the database connection
$connection->close();
?>
