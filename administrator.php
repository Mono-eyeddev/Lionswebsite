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
  font-family: Arial, sans-serif;
}

table th, table td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: left;
}

table tr:nth-child(even) {
  background-color: #f9f9f9;
}

table tr:hover {
  background-color: #f1f1f1; /* Highlight on hover */
}
@media screen and (max-width: 768px) {
  td a.updet, td a.delet {
    font-size: 12px;
    padding: 4px 8px;
  }
}

    </style>
</head>
<body>
    <style>
        h2{
              font-size: 20px;
                margin-top: 30px;
                margin-bottom: 15px;
                color: red;
                border-left: 5px solid #007bff;
                padding-left: 10px;
           
        }
        p{
            text-align: center;
            font-size: 30px;
        }
        a{
            text-decoration: none;
           color: #fff;
        }
        </style>
<div style="display: flex;">
    <a href="logout.php"> 
        <button class="Btn">
          <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
              <div class="text">log out</a></div>
        </button>

    </div>
      <style>
   .Btn {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 45px;
  height: 45px;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition-duration: .3s;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
  background-color: rgb(255, 65, 65);
}

/* plus sign */
.sign {
  width: 100%;
  transition-duration: .3s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sign svg {
  width: 17px;
}

.sign svg path {
  fill: white;
}
/* text */
.text {
  position: absolute;
  right: 0%;
  width: 0%;
  opacity: 0;
  color: white;
  font-size: 1.2em;
  font-weight: 600;
  transition-duration: .3s;
}
/* hover effect on button width */
.Btn:hover {
  width: 125px;
  border-radius: 40px;
  transition-duration: .3s;
}

.Btn:hover .sign {
  width: 30%;
  transition-duration: .3s;
  padding-left: 20px;
}
/* hover effect button's text */
.Btn:hover .text {
  opacity: 1;
  width: 70%;
  transition-duration: .3s;
  padding-right: 10px;
}
/* button click effect*/
.Btn:active {
  transform: translate(2px ,2px);
}
</style>


<h2><marquee style="font-size:20px;">Welcome, <?php echo $_SESSION['username']; ?></marquee></h2>
<p>This is the dashboard page. You are logged in.</p>
<h2>Logs</h2>
<div class="table-container">
<table id="logsTable" border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Login Time</th>
    </tr>
  </thead>
  <tbody></tbody>
  
<?php
$servername = "localhost";
$username   = "root";  
$password   = "";      
$dbname     = "lionsdb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT logs.log_id, login.username, logs.login_time
        FROM logs
        JOIN login ON logs.user_id = login.id
        ORDER BY logs.login_time DESC";

$result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['log_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['login_time']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='3'>No logs found</td></tr>";
    }
    ?>
</table>
</div>

<h2>Newsletter</h2>

<div class="table-container">
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Submitted at</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Include submitted_at and status in SELECT
    $sql = "SELECT id, name, email, number, submitted_at, status FROM newsletter";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["number"]; ?></td>
                <td><?php echo $row["submitted_at"]; ?></td> 
                <!-- Submission time column -->
                <td>
                <input type="checkbox" class="status-toggle" data-id="<?php echo $row['id']; ?>" data-table="newsletter" <?php if ($row['status'] == 'approved') echo 'checked'; ?>>
                </td>
                <td>
                       <div class="action-buttons">
                    <a class="updet" href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a class="delet" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                       </div>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>0 results</td></tr>";
    }

    $conn->close();
    ?>
</table>
</div>
<style>
        /* Style for the update and delete links */
a.updet, a.delet {
  padding: 6px 12px;
  border-radius: 12px;
  text-decoration: none;
  font-size: 14px;
  font-weight: bold;
  margin: 2px;
  display: inline-block;   /* sit side by side */   
  vertical-align: middle;  /* align properly */
}
.action-buttons {
  display: flex;
  gap: 8px;  /* space between buttons */
  padding: 6px 14px;
  margin-right: 6px;
  border-radius: 999px;   /* full pill shape */
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
  color: #fff;
  transition: background 0.3s ease;
}

a.updet {
  background-color: #007bff;
  color: white;
}

a.updet:hover {
  background-color: #0056b3;
}

a.delet {
  background-color: #dc3545;
  color: white;
}

a.delet:hover {
  background-color: #a71d2a;
}




    </style>
<h2>Contact</h2>

<div class="table-container">
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submitted at</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php
    // 🔹 Re-open connection for this section
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, email, message, submitted_at, status FROM contact";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["message"]; ?></td>
                <td><?php echo $row["submitted_at"]; ?></td>
                <td>
                    <input type="checkbox" 
                           class="status-toggle" 
                           data-id="<?php echo $row['id']; ?>" 
                           data-table="contact"
                           <?php if ($row['status'] == 'approved') echo 'checked'; ?>>
                </td>
                <td>
                       <div class="action-buttons">
                    <a class="updet" href="updateii.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a class="delet" href="deleteii.php?id=<?php echo $row['id']; ?>">Delete</a>
                       </div>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>0 results</td></tr>";
    }

    // 🔹 Close connection
    $conn->close();
    ?>
</table>
</div>

<h2>Admissions</h2>

<div class="table-container">
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number</th>
        <th>Subject</th>
        <th>Submitted at</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'lionsdb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the admissions table
    $sql = "SELECT id, name, number, subject, submitted_at, status FROM admissions";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["number"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["submitted_at"]; ?></td>
                <td>
                    <input type="checkbox" 
                           class="status-toggle" 
                           data-id="<?php echo $row['id']; ?>" 
                           data-table="admissions"
                           <?php if ($row['status'] == 'approved') echo 'checked'; ?>>
                </td>
                <td>
                       <div class="action-buttons">
                    <a class="updet" href="updateiii.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a class="delet" href="deleteiii.php?id=<?php echo $row['id']; ?>">Delete</a>
                       </div>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7'>0 results</td></tr>";
    }

    $conn->close();
    ?>
</table>
</div>
<!--style for the checkbox-->
<style>

.status-toggle{
  --primary-color: #00bb10ff;
  --secondary-color: #fff;
  --primary-hover-color: #18b803ff;
  /* checkbox */
  --checkbox-diameter: 20px;
  --checkbox-border-radius: 5px;
  --checkbox-border-color: #0c0000ff;
  --checkbox-border-width: 1px;
  --checkbox-border-style: solid;
  /* checkmark */
  --checkmark-size: 1.2;
}

.status-toggle, 
.status-toggle *, 
.status-toggle *::before, 
.status-toggle *::after {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

.status-toggle {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: var(--checkbox-diameter);
  height: var(--checkbox-diameter);
  border-radius: var(--checkbox-border-radius);
  background: var(--secondary-color);
  border: var(--checkbox-border-width) var(--checkbox-border-style) var(--checkbox-border-color);
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s;
  cursor: pointer;
  position: relative;
}

.status-toggle::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  -webkit-box-shadow: 0 0 0 calc(var(--checkbox-diameter) / 2.5) var(--primary-color);
  box-shadow: 0 0 0 calc(var(--checkbox-diameter) / 2.5) var(--primary-color);
  border-radius: inherit;
  opacity: 0;
  -webkit-transition: all 0.5s cubic-bezier(0.12, 0.4, 0.29, 1.46);
  -o-transition: all 0.5s cubic-bezier(0.12, 0.4, 0.29, 1.46);
  transition: all 0.5s cubic-bezier(0.12, 0.4, 0.29, 1.46);
}

.status-toggle::before {
  top: 40%;
  left: 50%;
  content: "";
  position: absolute;
  width: 4px;
  height: 7px;
  border-right: 2px solid var(--secondary-color);
  border-bottom: 2px solid var(--secondary-color);
  -webkit-transform: translate(-50%, -50%) rotate(45deg) scale(0);
  -ms-transform: translate(-50%, -50%) rotate(45deg) scale(0);
  transform: translate(-50%, -50%) rotate(45deg) scale(0);
  opacity: 0;
  -webkit-transition: all 0.1s cubic-bezier(0.71, -0.46, 0.88, 0.6),opacity 0.1s;
  -o-transition: all 0.1s cubic-bezier(0.71, -0.46, 0.88, 0.6),opacity 0.1s;
  transition: all 0.1s cubic-bezier(0.71, -0.46, 0.88, 0.6),opacity 0.1s;
}

/* actions */

.status-toggle:hover {
  border-color: var(--primary-color);
}

.status-toggle:checked {
  background: var(--primary-color);
  border-color: transparent;
}

.status-toggle:checked::before {
  opacity: 1;
  -webkit-transform: translate(-50%, -50%) rotate(45deg) scale(var(--checkmark-size));
  -ms-transform: translate(-50%, -50%) rotate(45deg) scale(var(--checkmark-size));
  transform: translate(-50%, -50%) rotate(45deg) scale(var(--checkmark-size));
  -webkit-transition: all 0.2s cubic-bezier(0.12, 0.4, 0.29, 1.46) 0.1s;
  -o-transition: all 0.2s cubic-bezier(0.12, 0.4, 0.29, 1.46) 0.1s;
  transition: all 0.2s cubic-bezier(0.12, 0.4, 0.29, 1.46) 0.1s;
}

.status-toggle:active:not(:checked)::after {
  -webkit-transition: none;
  -o-transition: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  transition: none;
  opacity: 1;
}      
/*table resize */
.table-container {
  max-width: 1500px; 
  overflow-x: auto; /* if it overflows on small screens */
}

</style>
<!--checkbox ajax fetch-->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Listen for checkbox changes across all tables
    const toggles = document.querySelectorAll(".status-toggle");

    toggles.forEach(toggle => {
        toggle.addEventListener("change", function () {
            let userId = this.getAttribute("data-id");
            let tableName = this.getAttribute("data-table"); // <-- NEW
            let newStatus = this.checked ? "approved" : "pending";

            // Send AJAX request
            fetch("change_status.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + userId + "&status=" + newStatus + "&table=" + tableName
            })
            .then(response => response.text())
            .then(data => {
                console.log("Server response:", data);
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    });
});
</script>

</body>
</html>
