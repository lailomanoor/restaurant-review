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

    // Prepare SQL statement to select user with given username
    $stmt = $conn->prepare("SELECT * FROM reviewer WHERE reviewer_username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a user with given username
    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['reviewer_password'])) {

            // Set session variable
            $_SESSION['username'] = $row['reviewer_username'];
            $_SESSION['role'] = 'user';

            // Prepare response JSON
            $response = array('success' => true, 'message' => 'Login successful');

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        } else {

            // Prepare response JSON
            $response = array('success' => false, 'message' => 'Invalid username or password');

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        }

    } else {

        // Prepare response JSON
        $response = array('success' => false, 'message' => 'Invalid username or password');

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();

    }

}
?>
