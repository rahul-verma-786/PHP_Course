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
    <label for="semester">Semester:</label>
    <input type="text" name="semester" id="semester" required>
    <button type="submit" name="submit">Submit</button>
</form>

<?php 
if(isset($_POST['submit'])) {
    $semester = $_POST['semester'];
    $checkSql = "SELECT semester FROM semester WHERE semester = '$semester'";
    $checkResult = $conn->query($checkSql);
  
    if ($checkResult->num_rows > 0) {
        echo "Semester already exists in the database.";
    } 
    else{  
    $sql = "INSERT INTO semester (semester) VALUES ('$semester')";

    if ($conn->query($sql) === TRUE) {
        echo "semester inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}

$sql = "SELECT * FROM semester";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Semester</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Semester</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["semester"] . "</td>";
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