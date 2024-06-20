<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "project1";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name,$port);
if(isset($_REQUEST['order_id'])){
    $order_id = $_REQUEST['order_id'];
    $sql = "SELECT * FROM order_details where order_id=$order_id";
    $result = $conn->query($sql);
}
else{
    header('location:/doAn/customer/home/');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order details</title>
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
            <th>Mã sản phẩm</th>
            <th>Số lượng</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Thể loại</th>
        </tr>
            <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        $id = $row['product_id'];
                        $sql_new = "SELECT * FROM products where id=$id";
                        $result_new = $conn->query($sql_new);
                        $row_new = $result_new->fetch_assoc()

                        ?>






                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['product_quantities']; ?></td>
                            <td><?php echo $row_new['name']; ?></td>
                            <td><?php echo $row_new['price']; ?></td>
                            <td><?php echo $row_new['themes']; ?></td>
                        <?php
                        echo "</tr>";
                    }
                  } else {
                    echo "0 results";
                  }


            ?>
    </table>
</body>
</html>