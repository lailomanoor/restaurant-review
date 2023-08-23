<?php

session_start();

// Check if user is logged in and is a moderator
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'moderator') {
    header("Location: login.php");
    exit();
}

$review_id = $_POST['review_id'];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "restaurant_review";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute delete statement only if user is a moderator
$stmt = $conn->prepare("DELETE FROM review WHERE review_id = ?");

if ($stmt) {
    $stmt->bind_param("i", $review_id);
    $execval = $stmt->execute();

    if ($execval === false) {
        echo "Error deleting review: " . $conn->error;
    } else {
        echo "Review with ID " . $review_id . " deleted successfully.";
    }
    $stmt->close();
} else {
    echo "Error: " . mysqli_error($conn);
}

$conn->close();

?>
