<?php include "studentdashboard.php";?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <style>
        body
         {
    font-family: Arial, sans-serif;
    margin: 0px;
}

h3,p {
    text-align: center;
    padding-right: 30px;
}

form {
    text-align: center;
}

table {
    width: 50%;
    border-collapse: collapse;
    margin-top: 20px;
    margin-left: 350px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #333;
    color: white;
}

tr:hover {
    background-color: #f5f5f5;
}

script {
    display: block;
    margin-top: 20px;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

     </style>
</head>
<body>
    <h3>Search User</h3>
    <form action="" method="post">
        <input type="text" name="search" id="search" required>
        <button type="submit">Search</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
       
        $search = $_POST['search'];

        $sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id
        WHERE users.firstname LIKE '%$search%' OR users.lastname LIKE '%$search%' OR users.username LIKE '%$search%'
        OR users.email LIKE '%$search%' OR users.city LIKE '%$search%' ";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
     
                <table>
                    <thead>
                        <tr>
                          
                            <th>ID</th>
                            <th>UserName</th>
                            <th>FirstName</th>
                            <th> Lastname</th>
                            <th> Email</th>
                            <th>Role</th>
                            <th>City</th>
                            <th>DOB</th>     
                            <th>Course</th>   
                            <th>Semester</th>  
                            <th>Department</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filteredData as $row) : ?>
                            <tr>
                               
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['firstname'] ?></td>
                                <td><?= $row['lastname'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td><?= $row['city'] ?></td>
                                <td><?= $row['dob'] ?></td>
                                <td><?= $row['course'] ?></td>
                                <td><?= $row['semester'] ?></td>
                                <td><?= $row['department'] ?></td>

                           
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
    <?php
            } else {
                echo "<p>User not found</p>";
            }
        }
    }

    ?>
<script src="script.js"></script> 
</body>

</html>
