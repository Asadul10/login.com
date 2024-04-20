<?php
session_start();

// Database connection
$servername = "localhost";
$username = "email"; // Replace with your database username
$password = "password"; // Replace with your database password
$database = "loginTest"; // Replace with your database name

$conn = new mysqli($localhost, $email, $password, $loginTest);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize inputs to prevent SQL injection
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Query to check if user exists
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, login successful
    $_SESSION['email'] = $email;
    header("Location: profile.php"); // Redirect to user profile page
} else {
    // User does not exist or incorrect credentials
    echo "Invalid email or password. <a href='login.html'>Try again</a>";
}

$conn->close();
?>
