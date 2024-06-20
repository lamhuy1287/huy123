<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "project1";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name,$port);

$order_id = $_REQUEST['order_id'];

if(isset($_REQUEST['accept'])){
    // khi click vào duyệt
    $data = $_REQUEST['accept'];

    // update
    $sql = "UPDATE orders SET order_status=$data WHERE order_id=$order_id";

    if ($conn->query($sql) === TRUE) {
        header('location:./manager_orders_customer.php');
    } else {
    echo "Error updating record: " . $conn->error;
    }

    
}
else if(isset($_REQUEST['cancel'])){
    // khi click vào hủy
    $data = $_REQUEST['cancel'];
    
    // update
    $sql = "UPDATE orders SET order_status=$data WHERE order_id=$order_id";

    if ($conn->query($sql) === TRUE) {
        header('location:./manager_orders_customer.php');
    } else {
    echo "Error updating record: " . $conn->error;
    }
}
else if(isset($_REQUEST['deliver'])){
    // khi click vào giao hàng
    $data = $_REQUEST['deliver'];
    
     // update
     $sql = "UPDATE orders SET order_status=$data WHERE order_id=$order_id";

     if ($conn->query($sql) === TRUE) {
         header('location:./manager_orders_customer.php');
     } else {
     echo "Error updating record: " . $conn->error;
     }
}
?>