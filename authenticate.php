<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'lionsdb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// Validate user credentials
$sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Authentication successful, set session and redirect to dashboard
    $_SESSION['username'] = $username;
    header("Location: administrator.php");
} else {
    // Authentication failed, redirect to login page with error
    header("Location: index.html");
}

//Logs login data
$sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found
    $row = $result->fetch_assoc();
    $user_id = $row['id'];

    // 2. Insert into logs
    $log_sql = "INSERT INTO logs (user_id) VALUES ($user_id)";
    if ($conn->query($log_sql) === TRUE) {
        echo "✅ Login successful. Log recorded!";
    } else {
        echo "Error inserting log: " . $conn->error;
    }
} else {
    echo "❌ Invalid username or password.";
}


$conn->close();
