<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Validate user inputs
$errors = array();

// Check name
if (empty($name)) {
    $errors[] = "Name is required";
}

// Check email
if (empty($email)) {
    $errors[] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

// Check subject
if (empty($subject)) {
    $errors[] = "Subject is required";
}

// Check message
if (empty($message)) {
    $errors[] = "Message is required";
}

// If there are validation errors, display them
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} else {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $execval = $stmt->execute();

        if ($execval) {
            echo "Registration successfully...";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
