<?php
include "studentdashboard.php";



$user_id = $firstname = $lastname = $email = $dob = $city = $semester = $course = $department = '';



$username = $_SESSION['username'];

$sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id
        WHERE username = '$username'";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $user_id = $row['id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $dob = $row['dob'];
    $city = $row['city'];
    $course = $row['course'];
    $semester = $row['semester'];
    $department = $row['department'];
}

if (isset($_POST['submit'])) {
    // Get the data from the form
    $user_id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $city = $_POST['city'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $department = $_POST['department'];

    // Update the data in the database
    $updateSql = "UPDATE users
                  LEFT JOIN allstudents ON users.id = allstudents.user_id
                  SET users.firstname='$firstname', users.lastname='$lastname', users.email='$email', users.dob='$dob', users.city='$city',
                      allstudents.course='$course', allstudents.semester='$semester', allstudents.department='$department'
                  WHERE users.id='$user_id'";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect to studentprofile.php after a successful update
        header("Location: studentprofile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
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
    <h2>Edit Student Details</h2>

    <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $user_id; ?>">

        <label for="username">UserName:</label>
        <input type="text" name="username" value="<?php echo $username; ?>"><br>

        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>"><br>

        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo $dob; ?>"><br>

        <label for="city">City:</label>
        <select name="city" id="city">
            <option value="0" selected>Select...</option>
            <option value="New Delhi" <?php echo ($row['city'] == 'New Delhi') ? 'selected' : ''; ?>>New Delhi</option>
            <option value="Mumbai" <?php echo ($row['city'] == 'Mumbai') ? 'selected' : ''; ?>>Mumbai</option>
            <option value="Noida" <?php echo ($row['city'] == 'Noida') ? 'selected' : ''; ?>>Noida</option>
            <option value="Gurgaon" <?php echo ($row['city'] == 'Gurgaon') ? 'selected' : ''; ?>>Gurgaon</option>
        </select><br>

        <label for="course">Course:</label>
        <input type="text" name="course" value="<?php echo $course; ?>"><br>

        <label for="semester">semester:</label>
        <input type="text" name="semester" value="<?php echo $semester; ?>"><br>

        <label for="department">Department:</label>
        <input type="text" name="course" value="<?php echo $department; ?>"><br>

       
        <button type="submit" id="submit" name="submit">Save Changes</button>
    </form>
</div>

</body>
</html>
