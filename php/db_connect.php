<?php
// db_connect.php
// Yeh file database se connection establish karegi.

// Database credentials
$servername = "localhost";
$username = "root"; // Aapka MySQL username (default 'root' hota hai)
$password = ""; // Aapka MySQL password (default blank hota hai)
$dbname = "travel_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
