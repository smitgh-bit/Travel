<?php
// signup.php
// Yeh script user registration ka data handle karegi.

session_start();
require 'db_connect.php'; // Database connection file include karein

// Check karein ki form submit hua hai ya nahi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['fullName'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $confirm_password = $_POST['confirmPassword'];

    // Check karein ki passwords match hote hain ya nahi
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // Password ko securely hash karein
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database mein user data insert karein
    // Sahi Code ✅
    $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $full_name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful hone par login page par redirect karein
        header("Location: ../login/login.html");
        exit();
    } else {
        // Agar email pehle se exist karta hai
        if ($conn->errno == 1062) {
            echo "Error: This email address is already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
