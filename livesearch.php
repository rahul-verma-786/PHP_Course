
<?php
include "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchvalue'])) 
{
    $searchvalue = $_POST['searchvalue'];

    $sql = "SELECT *
            FROM users
            WHERE firstname LIKE '$searchvalue%' OR lastname LIKE '%$searchvalue%' OR username LIKE '%$searchvalue%'
            OR email LIKE '%$searchvalue%' OR city LIKE '%$searchvalue%' OR role LIKE '%$searchvalue%'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $filteredData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo '<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>UserName</th>
                            <th>FirstName</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>City</th>
                            <th>DOB</th>                                 
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($filteredData as $row) {
                echo '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['firstname'] . '</td>
                        <td>' . $row['lastname'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>' . $row['city'] . '</td>
                        <td>' . $row['dob'] . '</td>
                    </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "<p>User not found</p>";
        }
    }
}