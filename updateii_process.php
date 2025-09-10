<?php
// Validate and sanitize input data
$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : '';
$subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

// Check if ID and other essential data are provided
if (!empty($id) && !empty($name) && $email !== false && !empty($subject) && !empty($message)) {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a statement
    $stmt = $conn->prepare("UPDATE contact SET name=?, email=?, subject=?, message=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $subject, $message, $id);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: administrator.php'); // Adjust the location as per your file structure
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request or missing data";
}

