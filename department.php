
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="smalltable.css" rel="stylesheet" />
</head>
<body>
<?php
include "admindashboard.php";

?>
<div class="container">
<form action="" method="post">
    <label for="department">Department:</label>
    <input type="text" name="department" id="department" required>
    <button type="submit" name="submit">Submit</button>
</form>

<?php 
if(isset($_POST['submit'])) {
    $departmentName = $_POST['department'];
    $checkSql = "SELECT department_name FROM department WHERE department_name = '$departmentName'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
        echo "Department already exists in the database.";
    } else {  
        $sql = "INSERT INTO department (department_name) VALUES ('$departmentName')";
        if ($conn->query($sql) === TRUE) {
            echo "Department inserted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$sql = "SELECT * FROM department";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Departments</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Department ID</th><th>Department</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["department_id"] . "</td>";
        echo "<td>" . $row["department_name"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No semester found in the database.";
}
?>
</div>

<script src="script.js"></script> 
</body>
</html>