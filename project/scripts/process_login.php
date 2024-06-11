<?php
session_start();
include '../config.php';

// Display all errors (useful for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists and fetch the hashed password
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['admin_id'] = $user_id;
            $_SESSION['username'] = $username;

            // Redirect to the admin dashboard or home page
            header("Location: ../admin/new_post.php");
            exit();
        } else {
            // Incorrect password
            echo "Invalid username or password.";
        }
    } else {
        // Username not found
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

