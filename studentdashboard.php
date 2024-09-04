<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admindashboard.css">
    <link rel="stylesheet" href="studenttable.css">
    <title>Student Dashboard</title>
</head>
<body>
    <header>
        <h1>Student Dashboard</h1>
        <?php 
          
            echo " WELCOME " .$_SESSION['username']; 
          ?>
    </header>

    <nav>
        <a href="studentprofile.php">My Profile</a>
        <a href="studentsearch.php">Home</a>
        <a href="#">Course</a>
        <a href="#">Semester</a>
        <a href="#">Department</a>
        <a href="studenttable.php">See All Data</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
