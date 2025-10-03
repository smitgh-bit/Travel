<?php
// login.php (Corrected Version)

session_start();
require 'db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Database se user ko email ke through find karein (Sahi column naamo ke saath)
    $sql = "SELECT user_id, user_name, user_password FROM users WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Password verify karein (Sahi column naam ke saath)
        if (password_verify($password, $user['user_password'])) {
            // Password correct hai, session create karein (Sahi column naamo ke saath)
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>