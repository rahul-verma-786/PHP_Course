
<?php
include "admindashboard.php";
?>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : ''; 
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $city = $_POST['city'];
    $hobbies = isset($_POST['hobbies']) ? implode(',', $_POST['hobbies']) : '';
    $defaultImage = '0';

    $userInsertSQL = "INSERT INTO `users` (username, password, role, email, dob, gender, firstname, lastname, city, hobbies, image_src)
                     VALUES ('$username', '$password', '$role', '$email', '$dob', '$gender', '$firstname', '$lastname', '$city', '$hobbies',$defaultImage)";

    if ($conn->query($userInsertSQL) === TRUE) {
  
        $user_id = $conn->insert_id;

      
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $department = $_POST['department'];

        $allStudentsInsertSQL = "INSERT INTO `allstudents` (user_id, course, semester, department)
                                VALUES ('$user_id', '$course', '$semester', '$department')";

        if ($conn->query($allStudentsInsertSQL) === TRUE) {
            header("Location: admintable.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

     <link href="form.css" rel="stylesheet" />
    <h1> Add  </h1>
     <form action="" method="post">
        <table>
            <tr>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <td><label for="username">UserName:</label></td>
                <td><input type="text" placeholder="Enter your username" id="username" name="username"></td>
              
            </tr>

            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" placeholder="********" id="password"  name="password" autocomplete="new-password"></td>
               
            </tr>

            <tr>
    <td>
        <label for="role">Role:</label>
       <td> <select name="role" id="role"  required onchange="toggleStudentFields()">
            <option value="0" selected>Select...</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select>
          </td>
     </td>
    </tr>

            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" placeholder="example@gmail.com" id="email" name="email"></td>
               
            </tr>

            <tr>
                <td><label for="dob">Date of Birth:</label></td>
                <td><input type="date" id="dob" name="dob"></td>
                
            </tr>

            <tr>
                <td><label>Gender:</label></td>
             <td>
                    <input type="radio"  name="gender" id="male" value="Male"><label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="Female"><label for="female">Female</label>
                    
            </td>
            </tr>
            <tr>
           
           <td><label for="firstname">FirstName:</label></td>
           <td><input type="text" placeholder="Enter your firstname" id="firstname" name="firstname"></td>   
       </tr>


       <tr>
      
      <td><label for="lastname">LastName:</label></td>
      <td><input type="text" placeholder="Enter your Lastname" id="lastname" name="lastname"></td>   
  </tr>



            <tr>
                    <td><label>Hobbies:</label></td>
                    <td>
                        <input type="checkbox" id="singing" name="hobbies[]" value="singing"><label for="singing">Singing</label>
                        <input type="checkbox" id="dancing" name="hobbies[]" value="dancing"><label for="dancing">Dancing</label>
                        <input type="checkbox" id="playing" name="hobbies[]" value="playing"><label for="playing">Playing</label>
                    </td>
                 
                </tr>

            <tr>
    <td><label for="city">City:</label></td>
    <td>
        <select name="city" id="city">
            <option value="0" selected>Select...</option>
            <option value="New Delhi">New Delhi</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Noida">Noida</option>
            <option value="Gurgaon">Gurgaon</option>
        </select>
    </td>
</tr>
<tr>
    <td><label for="course">Course:</label></td>
    <td>
        <select name="course" id="course">
            <?php
            $courseSql = "SELECT course_name FROM course";
            $courseResult = $conn->query($courseSql);

            if ($courseResult->num_rows > 0) {
                echo '<option value="0" selected>Select...</option>';

                while ($courseRow = $courseResult->fetch_assoc()) {
                    echo '<option value="' . $courseRow["course_name"] . '">' . $courseRow["course_name"] . '</option>';
                }
            } else {
                echo '<option value="0" selected>No courses found in the database.</option>';
            }
            ?>
        </select>
    </td>
</tr>

            <tr>
                <td><label for="semester">Semester:</label></td>
                <td>
                    <select name="semester" id="semester">
                        <?php
                        $sql = "SELECT semester FROM semester";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<option value="0" selected>Select...</option>';

                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["semester"] . '">' . $row["semester"] . '</option>';
                            }
                        } else {
                            echo '<option value="0" selected>No semester found.</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="department">Department:</label></td>
                <td>
                    <select name="department" id="department">
                        <?php
                        $sql = "SELECT department_name FROM department";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<option value="0" selected>Select...</option>';

                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["department_name"] . '">' . $row["department_name"] . '</option>';
                            }
                        } else {
                            echo '<option value="0" selected>No department found.</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>



        </table>  
        <input type="submit" value="Submit" id="submit" name="submit">
    </form>    
    <script src="script.js"></script> 

</body>
</html>