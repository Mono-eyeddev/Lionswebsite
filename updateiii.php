<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'lionsdb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID parameter is provided
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the database for the specified ID
    $sql = "SELECT id, name, number, subject FROM admissions WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Display the form for updating the record
        echo "<h2>Update Record</h2>";
        echo "<form class='updform' action='updateiii_process.php' method='POST'>";
        echo "<input type='hidden' name='id' value='".$row["id"]."'>";
        echo "Name: <input type='text' name='name' value='".$row['name']."'><br>";
        echo "Number: <input type='text' name='number' value='".$row['number']."'><br>";
        echo "Subject: <input type='text' name='subject' value='".$row['subject']."'><br>";
        echo "<input type='submit' name='update' value='Update'>";
        echo "</form>";
    } else {
        echo "Record not found";
    }
} else {
    echo "ID parameter not provided";
}

$conn->close();
?>
<style>
    body{
        font-family: Arial;
    }
    h2{
        color: #3c763d;
        text-align: center;
        }
        .updform{
            margin: auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 1px 1px 4px black;
            text-align: center;
            background-color: white;
            align-items: center;



        }
        .updform input[type=text]{
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            }
            .updform input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                }
                .updform input[type=submit]:hover{
                    background: darkgreen;
                }


</style>
</body>
</html>