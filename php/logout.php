<?php
// logout.php
session_start();

// Saare session variables ko unset karein
$_SESSION = array();

// Session ko destroy karein
session_destroy();

// Login page par redirect karein
header("Location: ../login/login.html");
exit;
?>
