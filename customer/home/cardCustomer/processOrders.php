<?php
session_start();
if(!isset($_SESSION["customer_id"])){
    header('location:/doAn/admin/login_logout/login.php');
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'project1';
$port = 3306; 
// Create connection
$conn = new mysqli($servername, $username, $password,$db_name,$port);

$customer_id = $_SESSION["customer_id"];
$customer_name = $_REQUEST['customer_name'];
$customer_phone = $_REQUEST['customer_phone'];
$customer_address = $_REQUEST['customer_address'];
$order_status = 0;
$created_at = time();
$total = $_SESSION['total'];

$sql = "INSERT INTO orders
VALUES (null,$customer_id,'$customer_name','$customer_phone','$customer_address',$order_status,$created_at,$total);";
if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
} else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
}

// cần lấy ra id của mỗi sản phẩm trong giỏ hàng và số lượng của mỗi id đó quantity => $_SESSION['cart'][$all_product_id[1]]
$all_product_id = $_SESSION['product_id'];
// lấy ra id hóa đơn vừa nhập vào
$sql = 'select * from orders where created_at='.$created_at;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
    $row = $result->fetch_assoc();
    // đã có mã hóa đơn
    $order_id = $row['order_id'];
    // đã có mã sản phẩm => $all_product_id 
    // đã có số lượng sản phẩm đi theo cái mã sản phẩm => $_SESSION['cart'][$all_product_id[1]]
    
    // lấy độ dài của mảng số lượng sản phẩm
    $max = count($all_product_id);
    for($i = 0; $i < $max; $i++){
        $product_id = $all_product_id["$i"];
        $product_quantity = $_SESSION['cart'][$all_product_id[$i]];
        $sql = "insert into order_details values($order_id, $product_id, $product_quantity);";
            if ($conn->query($sql) === TRUE) {
                echo "Bạn đã nhập thành công sản phẩm có id là: $product_id và số lượng là $product_quantity\n";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
    unset($_SESSION['cart']);
    header('location:/doAn/customer/home/home.php');
} else {
  echo "0 results";
}
?>