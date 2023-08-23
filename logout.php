<?php
session_start();

$previousPage = $_SERVER['HTTP_REFERER'];

// Unset all of the session variables
$_SESSION = array();
// Destroy the session
session_destroy();

header("Location: $previousPage");
exit();

?>
