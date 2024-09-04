
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online";
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("connection failed". $conn->connect_error);
}

session_start();
$parts = explode('/', $_SERVER["SCRIPT_NAME"]);
$file = $parts[count($parts) - 1];

 if( $file!= "index.php" && empty($_SESSION['username']) ){
    header("Location:index.php");
} 
?>