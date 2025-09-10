<?php
// Check if the form is submitted
if(isset($_POST['update'])) {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];

    // Update query
    $sql = "UPDATE newsletter SET name='$name', email='$email', number='$number' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: administrator.php'); // Adjust the location as per your file structure
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Form not submitted";
}
