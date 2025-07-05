<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            box-shadow: 200px;
        }
        th, td {
            border: 1px solid brown;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <style>
        h2{
            color : red;
            font-size: large;
           
        }
        p{
            text-align: center;
            font-size: 30px;
        }
        a{
            text-decoration: none;
            font-size: 20px;
        }
        </style>
        <button class="btn"> <a href="logout.php">log out </a>
</button>
<h2><marquee>Welcome, <?php echo $_SESSION['username']; ?></marquee></h2>
<p>This is the dashboard page. You are logged in.</p>
<style>
    .btn {
 padding: 1.1em 2em;
 background: none;
 border: 2px solid #fff;
 font-size: 15px;
 color: #131313;
 cursor: pointer;
 position: relative;
 overflow: hidden;
 transition: all 0.3s;
 border-radius: 12px;
 background-color: burlywood;
 font-weight: bolder;
 box-shadow: 0 2px 0 2px #000;
}

.btn:before {
 content: "";
 position: absolute;
 width: 100px;
 height: 120%;
 background-color: #ff6700;
 top: 50%;
 transform: skewX(30deg) translate(-150%, -50%);
 transition: all 0.5s;
}

.btn:hover {
 background-color: blue;
 color: #fff;
 box-shadow: 0 2px 0 2px #0d3b66;
}

.btn:hover::before {
 transform: skewX(30deg) translate(150%, -50%);
 transition-delay: 0.1s;
}

.btn:active {
 transform: scale(0.9);
}
    </style>
<h2>Newsletter</h2>

<table>
    <tr>
        <th>Name</th>
        <th>email</th>
        <th>phone number</th>
        <!-- Add more columns as needed -->
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT name, email, number FROM newsletter";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["number"]."</td></tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</table>
<h2>contact messages</h2>

<table>
    <tr>
        <th>name</th>
        <th>email</th>
        <th>subject</th>
        <th>message</th>
        <!-- Add more columns as needed -->
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT name, email, subject, message FROM contact";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["subject"]."</td><td>".$row["message"]."</td></tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</table>
<h2>Admission</h2>

<table>
    <tr>
        <th>name</th>
        <th>number</th>
        <th>subject</th>
        <!-- Add more columns as needed -->
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT name, number, subject FROM admissions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["number"]."</td><td>".$row["subject"]."</td></tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</table>
</body>
</html>
