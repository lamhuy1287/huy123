<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'project1';
$port = 3306; 

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name, $port);

if(!isset($_SESSION['customer_id'])){
    header('location:/doAn/customer/home/');
    die();
}

$id_customer = $_SESSION['customer_id']; 

$sql = "SELECT * FROM orders where customer_id = $id_customer";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Customer</title>
    <style>
    table{
        border: solid 1px black;
    }
    td, th{
        border: solid 1px black;
    }
  </style>
</head>
<body>
    <table>
        <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Trạng thái đơn hàng</th>
            <th>Thời gian đặt hàng</th>
            <th>Tổng tiền</th>
            <th>Chi tiết</th>
        </tr>
            <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                     ?>
                        <td><?php echo $row['customer_name'] ?></td>
                        <td><?php echo $row['customer_phone'] ?></td>
                        <td><?php echo $row['customer_address'] ?></td>
                        <td>
                        
                           <?php  
                             $data = $row['order_id'];
                             
                             if($row['order_status'] == 0){
                               echo "<p'>"."Đang chờ duyệt"."</p>";
                             }
                             else if($row['order_status'] == 1){
                                echo "<p style='background-color:yellow;'>"."Đang giao"."</p>";
                             }
                             else if($row['order_status'] == 2){
                                echo "<p'>"."Thành công"."</p>";
                             }
                             else{
                                echo "Đơn hàng đã bị hủy";
                             }
                        
                            ?>
                          
                        </td>
                        <td><?php echo date("Y-m-d", $row['created_at']); ?></td>
                        <td><?php echo $row['total'] ?></td>
                        <td><form action='./order_detail_customer.php' method='post'>
                            <button style='background-color:green;'>Chi tiết</button>
                            <?php echo "<input name='order_id' value='$data' hidden>"; ?>
                            </form>
                        </td>
                    <?php
                    echo "</tr>";
                    }
                  } else {
                    echo "<p>"."Chưa có hóa đơn nào. Hãy đi mua hàng!!!"."</p>";
                  }
            ?>
    </table>
</body>
</html>