<?php
session_start();

// Predefined credentials (you can add more users here if needed)
$credentials = [
    'client1' => 'password123',
    'client2' => 'securepass456',
    'client3' => 'project789'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the provided username exists and the password matches
    if (isset($credentials[$username]) && $credentials[$username] === $password) {
        // Login successful
        $_SESSION['user_id'] = $username;
        header('Location: dashboard.php');
    } else {
        // Invalid login
        echo "Invalid username or password";
    }
}
?>
