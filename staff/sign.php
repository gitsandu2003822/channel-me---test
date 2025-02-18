<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example credentials (replace with database validation)
    $stored_username = "admin";
    $stored_password = "password123"; // In a real case, use hashed passwords

    // Simple validation
    if ($username === $stored_username && $password === $stored_password) {
        // Store session data
        $_SESSION['user'] = $username;

        // Redirect to a dashboard page after successful login
        header('Location: dashboard.php'); 
        exit();
    } else {
        // Invalid login, set error message
        $error_message = "Invalid username or password";
    }
}

// You can output the error message here if you need to display it in your HTML
if (isset($error_message)) {
    echo $error_message;
}
?>
