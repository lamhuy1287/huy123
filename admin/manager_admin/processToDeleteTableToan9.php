<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else{
    header("location:./showInfo.php");
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
$sql = "DELETE FROM user_admin WHERE id=$id";
$result = mysqli_query($conn, $sql);
if ($conn->query($sql) === TRUE) {
    // echo "Record deleted successfully";
    header("location:./showInfo.php");
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  

?>