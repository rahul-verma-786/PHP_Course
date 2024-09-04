<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   
    <link rel="stylesheet" href="admindashboard.css">
    <link rel="stylesheet" href="studenttable.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <?php 
            echo " WELCOME " .$_SESSION['username']; 
          ?>

    </header>
    <nav>
    <a href="adminprofile.php">My Profile</a>
        <a href="search.php">Home</a>
        <a href="course.php">Course</a>
        <a href="semester.php">Semester</a>
        <a href="department.php">Department</a>
        <a href="create.php">Registration</a>
        <a href="admintable.php">Manage Data</a>
        <a href="logout.php">Logout</a>
       
    </nav>
</body>
</html>
