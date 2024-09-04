<?php
include "admindashboard.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $hobbies = isset($_POST['hobbies']) ? implode(',', $_POST['hobbies']) : '';
    $city = $_POST['city'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $department = $_POST['department'];

    $sql = "UPDATE users
            SET username='$username', email='$email', password='$password', gender='$gender',
                dob='$dob', hobbies='$hobbies', city='$city'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $sqlUpdateStudent = "UPDATE allstudents
                            SET course='$course', semester='$semester', department='$department'
                            WHERE user_id='$id'";

        if ($conn->query($sqlUpdateStudent) !== TRUE) {
            echo "Error updating student record: " . $conn->error;
        }
        header("Location: admintable.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$id = $_GET['id'];

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$sql = "SELECT users.*, allstudents.course, allstudents.semester, allstudents.department
        FROM users
        LEFT JOIN allstudents ON users.id = allstudents.user_id
        WHERE users.id = $id";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    

?>
 <link rel="stylesheet" href="form.css">
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <table>
        <tr>
            <td><label for="username">userName:</label></td>
            <td><input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"></td>
        </tr>

        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"></td>
        </tr>

        <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" id="password" name="password" autocomplete="new-password" value="<?php echo $row['password']; ?>"></td>
        </tr>

        <tr>
            <td><label>Gender:</label></td>
            <td>
                <input type="radio" name="gender" id="male" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?>>
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?>>
                <label for="female">Female</label>
            </td>
        </tr>

        <tr>
            <td><label for="dob">Date of Birth:</label></td>
            <td><input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>"></td>
        </tr>

        <tr>
            <td><label>Hobbies:</label></td>
            <td>
                <input type="checkbox" id="singing" name="hobbies[]" value="singing" <?php echo (in_array('singing', explode(',', $row['hobbies']))) ? 'checked' : ''; ?>>
                <label for="singing">Singing</label>

                <input type="checkbox" id="dancing" name="hobbies[]" value="dancing" <?php echo (in_array('dancing', explode(',', $row['hobbies']))) ? 'checked' : ''; ?>>
                <label for="dancing">Dancing</label>

                <input type="checkbox" id="playing" name="hobbies[]" value="playing" <?php echo (in_array('playing', explode(',', $row['hobbies']))) ? 'checked' : ''; ?>>
                <label for="playing">Playing</label>
            </td>
        </tr>

        <tr>
            <td><label for="city">City:</label></td>
            <td>
                <select name="city" id="city">
                    <option value="0" selected>Select...</option>
                    <option value="New Delhi" <?php echo ($row['city'] == 'New Delhi') ? 'selected' : ''; ?>>New Delhi</option>
                    <option value="Mumbai" <?php echo ($row['city'] == 'Mumbai') ? 'selected' : ''; ?>>Mumbai</option>
                    <option value="Noida" <?php echo ($row['city'] == 'Noida') ? 'selected' : ''; ?>>Noida</option>
                    <option value="Gurgaon" <?php echo ($row['city'] == 'Gurgaon') ? 'selected' : ''; ?>>Gurgaon</option>
                </select>
            </td>
        </tr>

        <tr>
    <td><label for="course">Course:</label></td>
    <td>
        <select id="course" name="course">
            <?php
            
            $courseQuery = "SELECT * FROM course";
            $courseResult = mysqli_query($conn, $courseQuery);

            while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                $selected = ($courseRow['course_id'] == $row['course']) ? "selected" : "";
                echo "<option value='{$courseRow['course_id']}' $selected>{$courseRow['course_name']}</option>";
            }
            ?>
        </select>
    </td>
</tr>


        <tr>
            <td><label for="semester">Semester:</label></td>
            <td><input type="text" id="semester" name="semester" value="<?php echo $row['semester']; ?>"></td>
        </tr>


        <tr>
            <td><label for="department">Department:</label></td>
            <td><input type="text" id="department" name="department" value="<?php echo $row['department']; ?>"></td>
        </tr>

    </table>
    <input type="submit" value="submit" id="submit" name="submit">
</form>
<?php 
}
?>
