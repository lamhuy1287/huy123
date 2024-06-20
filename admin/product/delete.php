<?php

$product_id = $_POST['product_id'];

#kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}

$sql = "DELETE FROM products WHERE id='$product_id' ";
mysqli_query($conn, $sql);
#chuyển hướng về trang quản lý
header("Location:/doAn/admin/product/index.php");