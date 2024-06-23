<?php
$product_id=$_POST['product_id'];
$product_code = $_POST['product_code'];
$name = str_replace("'","\'",$_POST['name']);
$price = $_POST['price'];
$themes = $_POST['themes'];
$description = $_POST['description'] ?? '';


// Kiem tra them xem co cap nhat hinh hay ko
 if(isset($_FILE['image_file'])){
// Thuc hien update file
$target_dir = "../../public/uploads/";
$target_file = $target_dir. basename($_FILES["image_file"]["name"]);
# Lưu ảnh tạm thời vào đường dẫn target_file 
move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);

$sql = "UPDATE products SET product_code = '$product_code' , name = '$name ', price = '$price',themes ='$themes', description='$description',image='$target_file' WHERE id ='$product_id' ";
}
else{
$sql = "UPDATE products SET product_code = '$product_code' , name = '$name ', price = '$price',themes ='$themes', description='$description' WHERE id ='$product_id' ";
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
echo $sql;
 $result = mysqli_query($conn,$sql);
// #chuyển hướng về trang chủ
 header("Location:/doAn/admin/product/index.php");

 