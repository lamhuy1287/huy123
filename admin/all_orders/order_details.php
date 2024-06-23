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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.5/datatables.min.css" rel="stylesheet">
 
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.5/datatables.min.js"></script>
    <style>
    table{
        border: solid 1px black;
    }
    td, th{
        border: solid 1px black;
    }
    .text{
            font-size:30px;
            
        }
        .sidebar {
            position: fixed; /* Làm cho sidebar đứng yên */
            height: auto; /* Chiều cao toàn màn hình */
        }
  </style>
</head>
<body>
<div class="d-flex min-vh-100">
<!-- slidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 text-white " style="width: 280px;background-color:rgb(252,188,56);">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-black text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="text" >ADMIN</span>
    </a>
    <hr style="border:1px solid black">
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="/doAn/admin/product/index.php" class="nav-link  text-black" >
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Quản lý sản phẩm
        </a>
      </li>
      <li>
        <a href="../../admin/all_orders/manager_orders_customer.php" class="nav-link active text-black" style="background-color:#FFFF00;">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Quản lý đơn hàng 
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-black">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Thống kê doanh thu
        </a>
      </li>
      <li>
        <a href="../../customer/home/home.php" class="nav-link text-black">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Trang khách hàng
        </a>
      </li>
      
      <li>
        <a href="../../admin/login_logout/logout.php" class="nav-link text-black">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Log out
        </a>
      </li>
    </ul>
    
   </div>
   <div class="container">
    <div class="container">
        <h1 style="text-align:center;">Chi tiết đơn hàng</h1>
        <table class="table table-bordered" id="product_table">
            <thead>
                <tr>

                    <th class="text-center">Mã sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Giá</th>

                </tr>
            </thead>
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

            <td>
               <p style="text-align:center;"> <?php echo $row_new['product_code']; ?> </p>
            </td>
            <td>
            <p style="text-align:center;"><?php echo $row['product_quantities']; ?></p>
            </td>
            <td>
                <?php echo $row_new['name']; ?>
            </td>
            <td>
            <p style="text-align:center;"><?php echo $row_new['price']; ?>$</p>
            </td>

            <?php
                        echo "</tr>";
                    }
                  } else {
                    echo "0 results";
                  }

            ?>

        </table>
        <script>
            let table = new DataTable('#product_table');
        </script>
    </div>
</div>
</div>
</body>
</html>