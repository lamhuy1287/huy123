<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "project1";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name,$port);

$sql = "SELECT * FROM orders order by order_id desc;";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
    th.address-column, td.address-column {
  width: 30%; /* adjust the width to your liking */
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
          Product Management
        </a>
      </li>
      <li>
        <a href="../../admin/all_orders/manager_orders_customer.php" class="nav-link active text-black" style="background-color:#FFFF00;">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Order management
        </a>
      </li>
      <li>
        <a href="../../admin/chart/chart_money.php" class="nav-link text-black">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Revenue statistics
        </a>
      </li>
      <li>
        <a href="../../customer/home/home.php" class="nav-link text-black">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Customer page
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
       <h1 style="text-align:center;">
       Entire order</h1>
        <table class="table table-bordered" id="product_table">
            <thead>
                <tr>
     
      <th class="text-center">No.</th>

      <th class="text-center">Customer name</th>
      <th class="text-center">Phone number</th>
      <th class="text-center">Address</th>
      <th class="text-center">Order status</th>    
      <th class="text-center">Total amount</th>
      <th class="text-center">Order details</th>
                </tr>
            </thead>
         <?php
            if ($result->num_rows > 0) {
              $count = 0 ;
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    ?> 
                        
                        <td><?php $count++; echo $count?> </td>

                        <td class="text-center"><?php echo $row['customer_name']; ?></td>
                        <td class="text-center"><?php echo $row['customer_phone']; ?></td>
                        <td class="address-column"><?php echo $row['customer_address'];?></td>
                        <td>
                           <form action="process_change_status.php" method="post">
                           <?php  
                            $data = $row['order_id'];
                             echo "<input name='order_id' value='$data' hidden>";
                             if($row['order_status'] == 0){
                                echo "<button name='accept' value='1' class='btn btn-success mr-2'>"."Acceptance"."</button>";
                                
                                echo "<button name='cancel' value='-1' class='btn btn-danger mt-2'>"."Cancel"."</button>";
                             }
                             else if($row['order_status'] == 1){
                                echo "<button name='deliver' value='2' class='btn btn-primary'>"."Delivering"."</button>";
                             }
                             else if($row['order_status'] == 2){
                                echo "<p style='color:green;'>Delivered successfully</p>";
                             }
                             else{
                                echo "<p style='color:red;'>Order canceled</p>";
                             }
                        
                            ?>
                           </form>
                        </td>
                        
                        <td class="text-center"><?php echo $row['total'].'$' ?></td>
                        <form action="./order_details.php" method="post">
                        <td>
                            <?php 
                                echo "<button type='submit' class='btn btn-warning m-2'>See more</button>"; 
                                $data = $row['order_id'];
                                echo "<input name='order_id' value='$data' hidden>";
                            ?>
                        </td>
                        </form>
                        
                    <?php
                    echo "</tr>";
                }
              } else {
                echo "<p>"."Hiện tại chưa có hóa đơn nào được đặt"."</p>";
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