<?php
include "admindashboard.php";


$user_id = $firstname = $lastname = $email = $dob = $city = $image_src = '';
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $user_id = $row['id'];
    $image_src = $row['image_src'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $dob = $row['dob'];
    $city = $row['city'];
}

// Handle file upload
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

// Handle form submission
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $user_id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $city = $_POST['city'];

    if ($_FILES['profile_picture']['error'] == 0) {
        $filename = $_FILES['profile_picture']['name'];
        $tempname = $_FILES['profile_picture']['tmp_name'];
        $folder = "./courseimages/" . $filename;

        move_uploaded_file($tempname, $folder);

        $image_src = $folder;
    }

    $updateSql = "UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', dob='$dob', city='$city', image_src='$image_src' WHERE id='$user_id'";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: adminprofile.php");
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
    <h2>Edit Admin Details</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">

        <img src="<?php echo $row['image_src']; ?>" alt="" style="max-width: 200px; height: 200px; float:right;"><br>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" style="margin-bottom: 12px;">

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
            <option value="New Delhi" <?php echo ($city == 'New Delhi') ? 'selected' : ''; ?>>New Delhi</option>
            <option value="Mumbai" <?php echo ($city == 'Mumbai') ? 'selected' : ''; ?>>Mumbai</option>
            <option value="Noida" <?php echo ($city == 'Noida') ? 'selected' : ''; ?>>Noida</option>
            <option value="Gurgaon" <?php echo ($city == 'Gurgaon') ? 'selected' : ''; ?>>Gurgaon</option>
        </select><br>

        <button type="submit" id="submit" name="submit">Save Changes</button>
    </form>
</div>

</body>
</html>
