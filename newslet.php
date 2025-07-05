<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];

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

// Validate phone number
if (empty($number)) {
    $errors[] = "Phone number is required";
} elseif (!preg_match("/^\+?[0-9]{7,15}$/", $number)) {
    $errors[] = "Invalid phone number format. Please enter a valid phone number";
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
        $stmt = $conn->prepare("INSERT INTO newsletter (name, email, number) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $email, $number);
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
