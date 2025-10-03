<?php
// booking.php
// Yeh script trip booking form ka data handle karegi.

session_start();

// Check karein ki user logged in hai ya nahi
if (!isset($_SESSION['user_id'])) {
    // Agar logged in nahi hai, to login page par bhej dein
    header("Location: ../login/login.html");
    exit();
}

require 'db_connect.php'; // Database connection file include karein

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $destination = $_POST['destination'];
    $how_many = $_POST['how_many'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $details = $_POST['details'];

    // Validate dates
    if (empty($destination) || empty($how_many) || empty($start_date) || empty($end_date)) {
        die("Please fill all required fields.");
    }
    
    // Database mein booking data insert karein
    $sql = "INSERT INTO bookings (user_id, destination, how_many, start_date, end_date, details) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisss", $user_id, $destination, $how_many, $start_date, $end_date, $details);

    if ($stmt->execute()) {
        echo "<h1>Booking Successful!</h1>";
        echo "<p>Your trip to " . htmlspecialchars($destination) . " has been booked.</p>";
        echo '<a href="dashboard.php">Go to Dashboard</a>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
