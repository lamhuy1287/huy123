<?php
$email = "";
$user_name = "";
$pass_word = "";
$status = 0;

if(isset($_POST["email"])){
    // echo "successfully";
    $email = $_POST["email"];
    $user_name = $_POST["username"];
    $pass_word = $_POST["password"];
    // echo $email, $username, $password;
}
else{
    header("location:../../customer/home/home.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
$time = time();
$sql = "insert into user_admin values (null,'$email','$user_name',md5('$pass_word'),$status,$time)";
// echo $sql;
if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
    header("location:./showInfo.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  

?>