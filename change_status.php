<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "lionsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$id     = intval($_POST['id']);
$status = $_POST['status'];
$table  = $_POST['table'];

// Only allow specific tables
$allowedTables = ['newsletter', 'contact', 'admissions'];
if (!in_array($table, $allowedTables)) {
    die("Invalid table");
}

$sql = "UPDATE $table SET status=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo "Status updated successfully in $table";
} else {
    echo "Error updating status: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
