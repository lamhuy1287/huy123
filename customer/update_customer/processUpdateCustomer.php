<?php

session_start();

if(isset($_SESSION["customer_id"])){
    $id = $_SESSION["customer_id"];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";
$conn = mysqli_connect($servername, $username, $password, $database);



if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
$sql = "UPDATE customers SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
  header('location:../home/file_user.php');
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();


?>