<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "restaurant_review";

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$userpassword = $_POST['password'];

// Hash the password
$hashed_password = password_hash($userpassword, PASSWORD_DEFAULT);

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement and bind parameters
$stmt = $conn->prepare("INSERT INTO reviewer (reviewer_firstname, reviewer_lastname, reviewer_username, reviewer_email, reviewer_password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $hashed_password);

// Initialize response array
$response = array();

// Execute statement
if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Registration successful.";
} else {
    $response['success'] = false;
    $response['message'] = "Registration failed. Try again.";
}

// Close statement and connection
$stmt->close();
$conn->close();

// Set the response header
header('Content-Type: application/json');

// Send the JSON response
echo json_encode($response);

?>
