<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Validate and sanitize input data
    $id = $_POST['id'];
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $number = isset($_POST['number']) ? htmlspecialchars($_POST['number']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';

    // Check if ID and other essential data are provided
    if (!empty($id) && !empty($name) && !empty($number) && !empty($subject)) {
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'lionsdb');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare a statement
        $stmt = $conn->prepare("UPDATE admissions SET name=?, number=?, subject=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $number, $subject, $id);

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
        echo "Invalid data provided";
    }
} else {
    echo "Invalid request";
}

