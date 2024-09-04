<?php
include "config.php";
$uid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
$deleteAllStudentsSql = "DELETE FROM allstudents WHERE user_id = $uid";
$deleteUsersSql = "DELETE FROM users WHERE id = $uid";
if ($conn->query($deleteAllStudentsSql) && $conn->query($deleteUsersSql)) { 
    header("Location: admintable.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
