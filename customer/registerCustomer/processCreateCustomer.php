<?php
session_start();
if(!isset($_GET['create'])){
    header("location:registerCustomer.php");
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
$tel = "";
$address = "";



$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$tel = $_POST['tel'];
$address = $_POST['address'];


$email_fix_injection = mysqli_real_escape_string($conn,$email);
$username_fix_injection = mysqli_real_escape_string($conn, $username);
$password_fix_injection = mysqli_real_escape_string($conn, $password);
$tel_fix_injection = mysqli_real_escape_string($conn, $tel);
$address_fix_injection = mysqli_real_escape_string($conn, $address);
// $fullName_fix_injection = mysqli_real_escape_string($conn, $fullName);

$sql = "insert into customers values (null,'$username_fix_injection','$email_fix_injection',md5('$password_fix_injection'),'$tel_fix_injection','$address_fix_injection');";
// echo $sql;
// if ($conn->query($sql) === TRUE) {
//     // echo "New record created successfully";
//     header("location:../home/home.php");
//   } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
//       $_SESSION['check_email'] = TRUE;
//     header("location:./registerCustomer.php");
//   }
if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
  header("location:../home/home.php");
} else {
  echo "Error updating record: " . mysqli_error($conn);
  $_SESSION['check_email'] = TRUE;
      header("location:./registerCustomer.php");
}
?>