<?php
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
    
   
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = $row['username'];

        if ($row['role'] === "admin") {
            header("Location: admindashboard.php");
        } elseif ($row['role'] === "student") {
            header("Location: studentdashboard.php");
        }
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body> 
    
    <div class="container">
        
        <h2>Login</h2>

        <form action="" method="post" id="loginForm" autocomplete="off">
            <label for="username">Username / Email</label>
            <input type="text" name="username">
            <span class="validation-message" id="emailcheck"></span>
            <br/>

            <label for="password">Password</label>
            <input type="password" name="password" autocomplete="new-password">
            <span class="validation-message" id="passwordcheck"></span>

           <label for="role">Role:</label>
           <select name="role" id="role">
                        <option value="0" selected>Select...</option>
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                      
           </select>
            <span class="validation-message" id="rolecheck"></span>



            <br/>

            <input type="submit" name="submit" value="Login">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>

        <!-- Validation of login form -->
        <script>
            $(document).ready(function() {
                $('#emailcheck').hide();
                $('#passwordcheck').hide();

                $('#loginForm').submit(function() {
                    if ($("input[name='username']").val() === "") {
                        $('#emailcheck').text("Please Enter The Username / Email.").show();
                    } else {
                        $('#emailcheck').hide();
                    }

                    if ($("input[name='password']").val() === "") {
                        $('#passwordcheck').text("Please Enter The Password.").show();
                    } else {
                        $('#passwordcheck').hide();
                    }

                          if ($("#role").val() === "0") { 
                        $('#rolecheck').text("Please Select a Role.").show();
                    } else {
                        $('#rolecheck').hide();
                    }


                    if ($("input[name='username']").val() === "" || $("input[name='password']").val() === "") {
                        return false;
                    }

                    return true;
                });
            });
        </script> 

    </div>
 
</body>
</html>
