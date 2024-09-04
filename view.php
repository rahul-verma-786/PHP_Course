
<?php
include "studentdashboard.php";


$studentId = isset($_GET['id']) ? $_GET['id'] : 1;
$sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id
        WHERE users.id = $studentId";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="details.css">
</head>
<body>

    <div class="container">
        <h2>Student Details</h2>

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="detail-row">
            <label for="username">UserName:</label>
            <span><?php echo $row['username']; ?></span>
        </div>

        <div class="detail-row">
            <label for="email">Email:</label>
            <span><?php echo $row['email']; ?></span>
        </div>

        <div class="detail-row">
            <label>Gender:</label>
            <span><?php echo $row['gender']; ?></span>
        </div>

        <div class="detail-row">
            <label for="dob">Date of Birth:</label>
            <span><?php echo $row['dob']; ?></span>
        </div>

        <div class="detail-row">
            <label>Hobbies:</label>
            <span><?php echo $row['hobbies']; ?></span>
        </div>

        <div class="detail-row">
            <label for="city">City:</label>
            <span><?php echo $row['city']; ?></span>
        </div>

        <div class="detail-row">
            <label for="course">Course:</label>
            <span><?php echo $row['course']; ?></span>
        </div>

        <div class="detail-row">
            <label for="semester">Semester:</label>
            <span><?php echo $row['semester']; ?></span>
        </div>

        <div class="detail-row">
            <label for="department">Department:</label>
            <span><?php echo $row['department']; ?></span>
        </div>

        <a href="studenttable.php" class="back-button">Back</a>
    </div>

</body>
</html>

<?php
   }else {
    echo "Student not found!";
}

?>
