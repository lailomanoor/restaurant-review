<?php

session_start();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "restaurant_review";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to select user with given username and password
    $stmt = $conn->prepare("SELECT * FROM moderator WHERE m_username = ? AND m_password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a user with given username and password
    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        // Set session variable
        $_SESSION['username'] = $row['m_username'];
        $_SESSION['role'] = 'moderator';

        // Prepare the response
        $response = array('success' => true, 'message' => 'Login successful');

    } else {

        // Prepare the response
        $response = array('success' => false, 'message' => 'Invalid username or password');

    }

    // Close database connection
    $stmt->close();
    $conn->close();

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

?>
