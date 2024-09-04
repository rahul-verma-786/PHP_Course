<?php
include "admindashboard.php";

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
}
?>

<?php
$folder = ""; 
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
        <h2>Admin Details</h2>

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      
        <img src="<?php echo $row['image_src']; ?>" alt="" style="max-width: 200px; height: 200px;  float:right;"><br>


        <label for="username">UserName:</label>
        <?php echo $row['username']; ?><br>

        <label for="firstname">Firstname:</label>
        <?php echo $row['firstname']; ?><br>

        <label for="lastname">Lastname:</label>
        <?php echo $row['lastname']; ?><br>

        <label for="email">Email:</label>
        <?php echo $row['email']; ?><br>

        <label>Role:</label>
        <?php echo $row['role']; ?><br>

        <label for="dob">Date of Birth:</label>
        <?php echo $row['dob']; ?><br>
   
        <!-- file upload -->
        
<form method="post" enctype="multipart/form-data">
    <label for="profile_picture"> Profile Picture:</label>
    <input type="file" name="profile_picture">
    <button type="submit" name="upload">Upload</button>
</form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])) {
        $filename = $_FILES["profile_picture"]["name"];
        $tempname = $_FILES["profile_picture"]["tmp_name"];
        $folder = "./courseimages/" . $filename;

        move_uploaded_file($tempname, $folder);

        $updateQuery = "UPDATE users SET image_src = '$folder' WHERE username = '$username'";

        if ($conn->query($updateQuery) === TRUE) {
       
        header("Location: adminprofile.php");
        exit();
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
}
?>

        <!-- file upload section end -->

        <a href="admineditprofile.php">Edit</a>
    </div>

    <script src="script.js"></script> 
</body>
</html>
