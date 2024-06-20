<?php
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
// Determine the current page
$sql = "SELECT id,product_code, name, image,themes, price FROM products ";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.5/datatables.min.css" rel="stylesheet">
 
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.5/datatables.min.js"></script>
    <style>
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
        <a href="/doAn/admin/product/index.php" class="nav-link active text-black" style="background-color:#FFFF00;">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Quản lý sản phẩm
        </a>
      </li>
      <li>
        <a href="../../admin/all_orders/manager_orders_customer.php" class="nav-link text-black">
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
<!-- CONTENT -->
<div class="container">
    <div class="container">
        <a class="btn btn-warning my-3"  href="/doAn/admin/product/create.php">Thêm sản phẩm mới</a>
        <table class="table table-bordered" id="product_table">
            <thead>
                <tr>
                    <th style="text-align:center;">Mã sản phẩm</th>
                    <th style="text-align:center;">Tên sản phẩm</th>
                    <th style="text-align:center;">Hình ảnh</th>
                    <th style="text-align:center;">Giá sản phẩm</th>
                    <th style="text-align:center;">Phân loại</th>
                    <th style="text-align:center;">Xóa</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td style='text-align:center;'> #". $row['product_code']. "</td>";
                echo "<td style='text-align:center;'>". $row['name']. "</td>";
                echo "<td>";
                echo "<img style='width:150px;' class='img-fluid' src='". $row['image']. "'/>";
                echo "</td>";
                echo "<td style='text-align:center;'>". $row['price']. " $</td>";
                echo "<td style='text-align:center;'>". $row['themes']. "</td>";
                echo "<td style='text-align:center;'>";
                echo "<form method ='POST' action='delete.php'>";
                $product_id = $row["id"];
                echo "<input name='product_id' value='$product_id' hidden>";
                echo "<button type='submit' class='btn btn-warning m-2'>xóa</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
           ?>
            <tbody>

            </tbody>

        </table>
        <script>
            let table = new DataTable('#product_table');
        </script>
    </div>
</div>
</body>
</html>