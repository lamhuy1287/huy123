<?php
session_start();
if(isset($_POST['email'])){
    $email = $_POST['email'];
    // echo $email;
    $pass_word = $_POST['password'];
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

$sql = "SELECT * FROM user_admin WHERE email='$email' and pass_word= MD5('$pass_word');";

  // echo $sql; exit;
$result = $conn->query($sql);


if ($result->num_rows == 1) {
    // output data of each row
    // while($row = $result->fetch_assoc()) {
    //   echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    // }
    // echo "Login Successfully";
    $row = $result->fetch_assoc();
    $_SESSION["admin"] =  $row["email"];
    // echo $_SESSION["admin"] ;exit();
    header("location:../manager_admin/showInfo.php");
  }
  
  $sql = "SELECT * FROM customers WHERE email='$email' and password= MD5('$pass_word');";
  //  echo $sql; exit();
  $result = $conn->query($sql);
  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $_SESSION["customer"] = $row['email'];
    $_SESSION["customer_name"] = $row['name'];
    $_SESSION["customer_id"] = $row['id'];
    
    // echo $_SESSION["customer_name"]; exit();
    // echo $_SESSION["customer"] ;exit();
    header("location:../../customer/home/home.php");
  }
  // echo $sql; exit();  
  else {
    $_SESSION["Check"] = false; 
    header("location:./login.php");
  }
?>