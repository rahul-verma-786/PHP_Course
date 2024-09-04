<?php
include "admindashboard.php";

$limit = 5;

if(isset($_GET['page'])&&is_numeric($_GET['page'])){
    $page=$_GET['page'];

}
else{
    $page=1;
}
$offset= ($page-1)*$limit;
$sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id
        ORDER BY users.id ASC
        LIMIT $offset, $limit";



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
    <style>
      .admin-pagination {
        display: flex;
        list-style: none;
        align-items: center;
        justify-content: center;
        width: 100%; 
        margin-top: 20px;
       
       
    }

    .admin-pagination li {
        margin: 0 5px;
      
    }

    .admin-pagination a {
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ccc;
        color: #333;
       
    }

    .admin-pagination a:hover {
        background-color: #555;
        color: white;
    }

    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Password</th>
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
                    <td><?= $row['password'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['dob'])); ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['firstname'] ?></td>
                    <td><?= $row['lastname'] ?></td>
                    <td><?= $row['city'] ?></td>
                    <td><?= $row['hobbies'] ?></td>
                    <td><?= $row['course'] ?></td>
                    <td><?= $row['semester'] ?></td>
                    <td><?= $row['department'] ?></td>
                    <td>
                        <a href="adminedit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="admindelete.php?id=<?= $row['id'] ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 
<!-- pagination code -->

<?php 
$sql1 = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
FROM users
LEFT JOIN allstudents ON users.id = allstudents.user_id";
 $result1 = mysqli_query($conn, $sql1) or die("query failed");
 $total_records = mysqli_num_rows($result1);

 if ($total_records > 0) {
     $total_page = ceil($total_records / $limit);
     echo '<ul class="pagination admin-pagination">';
    if($page>1){

        echo '<li><a href="admintable.php?page=' . ($page - 1) . '">Prev</a></li>';

    }
   
    for ($i = 1; $i <= $total_page; $i++) {
        if($i==$page){
            $active="active";
        }
        else{
            $active="";
        }
        echo '<li class="' . $active . '"><a href="admintable.php?page=' . $i . '">' . $i . '</a></li>';

    }
    if ($total_page > $page) {
        echo '<li><a href="admintable.php?page=' . ($page + 1) . '">Next</a></li>';
    }
    
    echo '</ul>';
}
?>
</body>
<script src="script.js"></script> 
</html>
