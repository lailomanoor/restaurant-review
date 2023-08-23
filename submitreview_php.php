<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit();
}

// Get username from session variable
$r_username = $_SESSION['username'];

$branch_id = $_POST['branch_id'];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "restaurant_review";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {

	// Check if user has already left a review for this branch
	$stmt = $conn->prepare("SELECT * FROM review WHERE reviewer_username = ? AND branch_id = ?");
	$stmt->bind_param("ss", $r_username, $branch_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		// User has already left a review for this branch
		$response = array('success' => false, 'message' => 'You have already left a review for this branch.');
	} else {
		// User has not left a review for this branch, submit new review
		$food_quality = $_POST['food-quality-input'];
		$customer_service = $_POST['customer-service-input'];
		$ambience = $_POST['ambience-input'];
		$pricing = $_POST['pricing-input'];
		$comment = $_POST['review-input'];

		$stmt = $conn->prepare("INSERT INTO review (reviewer_username, branch_id, r_food_quality, r_pricing, r_customer_service, r_ambience, recommendation) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $r_username, $branch_id, $food_quality, $pricing, $customer_service, $ambience, $comment);
		$execval = $stmt->execute();

		if (!$stmt) {
			$response = array('success' => false, 'message' => 'Error: ' . mysqli_error($conn));
		} else {
			$response = array('success' => true, 'message' => 'Review submitted successfully.');
		}
	}
	$stmt->close();
	$conn->close();

	// Return the JSON response
	header('Content-Type: application/json');
	echo json_encode($response);
}

?>
