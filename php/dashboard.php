<?php
// dashboard.php
session_start();

// Check karein ki user logged in hai ya nahi
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.html");
    exit();
}

require 'db_connect.php';
$user_id = $_SESSION['user_id'];

// User ki bookings fetch karein
$sql = "SELECT destination, start_date, end_date, booking_date FROM bookings WHERE user_id = ? ORDER BY booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Dashboard</title>
    <link rel="stylesheet" href="../login/login.css">
    <style>
        body { background: #f4f4f4; }
        .dashboard-container { max-width: 800px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 10px; box-shadow: var(--box-shadow-medium); }
        h1, h2 { text-align: center; color: var(--dark-color); }
        .welcome-msg { text-align: center; font-size: 1.2rem; margin-bottom: 20px; }
        .bookings-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .bookings-table th, .bookings-table td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .bookings-table th { background-color: var(--primary-color); color: white; }
        .no-bookings { text-align: center; color: #777; }
        .dashboard-links { text-align: center; margin-top: 30px; }
        .dashboard-links a { margin: 0 15px; text-decoration: none; color: var(--primary-color); font-weight: 600; font-size: 1.1rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to Your Dashboard</h1>
        <p class="welcome-msg">Hello, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>!</p>
        
        <div class="dashboard-links">
            <a href="../book.html">Book a New Trip</a>
            <a href="logout.php">Logout</a>
        </div>

        <h2>My Bookings</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Booked On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['destination']); ?></td>
                            <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-bookings">You have not booked any trips yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
