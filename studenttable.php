
<?php
include "studentdashboard.php";


$sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student table</title>
    <link rel="stylesheet" href="admindashboard.css">
    <link rel="stylesheet" href="studenttable.css">
</head>
<body>
<table>
        <thead>
            <tr>
                <th> ID</th>
                <th>UserName</th>
                <th>Role</th> 
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>FirstName</th>
                <th>Lastname</th>
                <th>City</th>
                <th>Hobbies</th>
                <th>Course</th>
                <th>Semester</th> 
                <th>Department</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row) : ?>
                <tr>
                   <td><?= $row['id'] ?></td>
                    <td><?= $row['username'] ?></td>
                   
                    <td><?= $row['role'] ?></td>   
                    <td><?= $row['email'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['dob'])); ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['firstname'] ?></td>
                    <td><?= $row['lastname'] ?></td>        
                    <td><?= $row['hobbies'] ?></td>
                    <td><?= $row['city'] ?></td>
                    <td><?= $row['course'] ?></td>
                    <td><?= $row['semester'] ?></td>
                    <td><?= $row['department'] ?></td>
                    <td><a href="view.php?id=<?= $row['id'] ?>">View</a></td>

                    
                  
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="script.js"></script> 
</body>
</html>