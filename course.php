
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course</title>
    <link href="smalltable.css" rel="stylesheet" />
</head>
<body>
<?php
include "admindashboard.php";

?>

<div class="container">
<form action="" method="post">
    <label for="course">Course Name:</label>
    <input type="text" name="course" id="course" required >
    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $courseName = $_POST['course'];
    $checkSql = "SELECT course_name FROM course WHERE course_name = '$courseName'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "Course already exists in the database.";
    } else {
       
        $insertSql = "INSERT INTO course (course_name) VALUES ('$courseName')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Course inserted successfully!";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
}

$sql = "SELECT * FROM course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Courses</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Course ID</th><th>Course Name</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["course_name"] . "</td>";
        
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No courses found in the database.";
}
?>
</div>
  
<script src="script.js"></script> 
</body>
</html>