<?php
// Retrieve form data
$name = $_POST['name'];
$number = $_POST['number'];
$subject = $_POST['subject'];

// Validation rules
$nameRequired = true;
$numberRequired = true;
$subjectRequired = true;
$nameMinLength = 3;
$nameMaxLength = 50;
$numberPattern = '/^[0-9]{10}$/'; // Assuming a 10-digit number format

// Validation checks
$errors = [];

if ($nameRequired && empty($name)) {
    $errors[] = 'Please enter your name.';
} elseif (!empty($name) && (strlen($name) < $nameMinLength || strlen($name) > $nameMaxLength)) {
    $errors[] = 'Name must be between 3 and 50 characters.';
}

if ($numberRequired && empty($number)) {
    $errors[] = 'Please enter your phone number.';
} elseif (!empty($number) && !preg_match($numberPattern, $number)) {
    $errors[] = 'Please enter a valid 10-digit phone number.';
}

if ($subjectRequired && empty($subject)) {
    $errors[] = 'Please enter a subject.';
}

// Handle validation results
if (count($errors) > 0) {
    // Display errors to the user
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
} else {
    // Process valid data (e.g., store in database, send email, etc.)
    echo 'Data is valid!';
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
        $stmt = $conn->prepare("INSERT INTO admissions (name, number, subject) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $number, $subject);
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

