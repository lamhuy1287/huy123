<?php
session_start();
// echo "file log out";
if(isset($_SESSION["admin"])){
    unset($_SESSION["admin"]);
}
if(isset($_SESSION["customer"])){
    unset($_SESSION["customer"]);
    unset($_SESSION["customer_name"]);
    unset($_SESSION["customer_id"]);
}
header('location:/DOAN/customer/home/home.php');

?>