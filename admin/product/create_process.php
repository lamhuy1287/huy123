<?php
// Lấy dữ liệu từ form
$product_code = $_POST['product_code'];
$name = str_replace("'","\'",$_POST['name']);
$price = $_POST['price'];
$themes = $_POST['themes'];
$description = $_POST['description'] ?? '';

// Thư mục lưu trữ ảnh
$target_dir = "../../public/upload/";
// Đường dẫn đầy đủ tới file ảnh
$target_file = $target_dir . basename($_FILES["image"]["name"]);

#lưu ảnh tạm thời vào đường dẫn target_file
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
#lưu vào db

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

$sql = "INSERT INTO products VALUES (NULL,'$product_code','$name','$price','$themes','$description','$target_file')";
$result = mysqli_query($conn,$sql);
#chuyển hướng về trang chủ
header("Location:index.php");
