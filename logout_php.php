<?php
session_start();

// Unset all of the session variables.
$_SESSION = array();
// Destroy the session.
session_destroy();

$response = array('success' => true, 'message' => 'Logout successful');
header('Content-Type: application/json');
echo json_encode($response);
?>
