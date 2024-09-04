<?php
include "studentdashboard.php";

$username = $_SESSION['username'];

$sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id
        WHERE username = '$username'";  

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
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

        <label for="username">UserName:</label>
        <?php echo $row['username']; ?><br>

        <label for="firstname">FirstName:</label>
        <?php echo $row['firstname']; ?><br>

        <label for="lastname">LastName:</label>
        <?php echo $row['lastname']; ?><br>

        <label for="email">Email:</label>
        <?php echo $row['email']; ?><br>

        <label for="role">Role:</label>
        <?php echo $row['role']; ?><br>

        <label for="dob">Date of Birth:</label>
        <?php echo $row['dob']; ?><br>

        <label for="course">Course</label>
        <?php echo $row['course']; ?><br>

        <label for="semester">Semester</label>
        <?php echo $row['semester']; ?><br>

          <label for="department">Department:</label>
            <?php echo $row['department']; ?><br>

        <a href="studenteditprofile.php">Edit</a>
    </div>


    <script>
    var currentUrl = window.location.pathname.split("/").pop();
    var activeLink = document.querySelector('nav a[href="' + currentUrl + '"]');
    console.log("Current URL: " + currentUrl);
    console.log("Active Link: ", activeLink);
    if (activeLink) {
        activeLink.classList.add("active");
    }
    </script>
</body>
</html>
