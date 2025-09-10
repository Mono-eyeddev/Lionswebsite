<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'lionsdb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checking if the ID parameter is provided
if(isset($_GET['id'])) {
    $id = intval($_GET['id']); // safety

    // If confirmed is not set, ask for confirmation
    if(!isset($_GET['confirmed'])) {
        echo "<script>";
        echo "if(confirm('Are you sure you want to delete this record?')) {";
        echo "    window.location.href = 'deleteiii.php?id=$id&confirmed=true';";
        echo "} else {";
        echo "    window.location.href = 'administrator.php';";
        echo "}";
        echo "</script>";
        exit; // stop script here after showing confirmation
    }

    // If confirmed = true, perform the delete operation
    if($_GET['confirmed'] === 'true') {
        $sql = "DELETE FROM admissions WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully'); window.location.href='administrator.php';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
} else {
    echo "ID parameter not provided";
}

$conn->close();
?>
