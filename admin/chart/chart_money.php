<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = 'project1';
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name, $port);

$sql = "SELECT * FROM orders WHERE order_status = 2;";
$result = $conn->query($sql);


function getMonth($time){
    $month = date('m',$time);
    return $month;
}

if ($result->num_rows > 0) {
    $data = [0,0,0,0,0,0,0,0,0,0,0,0];
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $month = getMonth($row['created_at']);
      if($month == '01'){ 
        $data[0] = $data[0] + $row['total'];
      }
      else if($month == '02'){
        $data[1] = $data[1] + $row['total'];
      }
      else if($month == '03'){
        $data[2] = $data[2] + $row['total'];
      }
      else if($month == '04'){
        $data[3] = $data[3] + $row['total'];
      }
      else if($month == '05'){
        $data[4] = $data[4] + $row['total'];
      }
      else if($month == '06'){
        $data[5] = $data[5] + $row['total'];
      }
      else if($month == '07'){
        $data[6] = $data[6] + $row['total'];
      }
      else if($month == '08'){
        $data[7] = $data[7] + $row['total'];
      }
      else if($month == '09'){
        $data[8] = $data[8] + $row['total'];
      }
      else if($month == '10'){
        $data[9] = $data[9] + $row['total'];
      }
      else if($month == '11'){
        $data[10] = $data[10] + $row['total'];
      }
      else if($month == '12'){
        $data[11] = $data[11] + $row['total'];
      }

    }
  } else {
    echo "0 results";
  }
//    var_dump($data);
   $text = "";
   for($i = 0; $i < count($data);$i++){
     $text = $text.$data[$i].',';
   }
//    echo $text;
   $text_data = substr($text,0,-1);
   $text_data = "[".$text_data.'],';
//    echo $text_data;
   $sum = 0;
   for($i = 0; $i < count($data); $i++){
    $sum += $data[$i];
   }

   $sql_product = 'SELECT product_id,MAX(quantity_count) AS max_quantity_count
                    FROM (SELECT product_id,COUNT(product_quantities) AS quantity_count
                    FROM order_details
                    GROUP BY product_id) AS subquery';
    $result_product = $conn->query($sql_product);
    
    $row_product = $result_product->fetch_assoc();

    $id_finally = $row_product['product_id'];
    $sql_finally = "select * from products where id=$id_finally;";
    
    $result_finally = $conn->query($sql_finally);
    
    $row_finally = $result_finally->fetch_assoc();

    $sql_orders = "SELECT * FROM orders";
    $result_orders = $conn->query($sql_orders);
    if ($result_orders->num_rows > 0) {
        // output data of each row
        $quantity_orders = [0,0,0,0,0,0,0,0,0,0,0,0];
        while($row_orders = $result_orders->fetch_assoc()) {
            $month = getMonth($row_orders['created_at']);
                if($month == '01'){ 
                    $quantity_orders[0]++; 
                }
                else if($month == '02'){
                    $quantity_orders[1]++;
                }
                else if($month == '03'){
                    $quantity_orders[2]++;
                }
                else if($month == '04'){
                    $quantity_orders[3]++;
                }
                else if($month == '05'){
                    $quantity_orders[4]++;
                }
                else if($month == '06'){
                    $quantity_orders[5]++;
                }
                else if($month == '07'){
                    $quantity_orders[6]++;
                }
                else if($month == '08'){
                    $quantity_orders[7]++;
                }
                else if($month == '09'){
                    $quantity_orders[8]++;
                }
                else if($month == '10'){
                    $quantity_orders[9]++;
                }
                else if($month == '11'){
                    $quantity_orders[10]++;
                }
                else if($month == '12'){
                    $quantity_orders[11]++;
                }

        }
      } else {
        echo "0 results";
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart JS</title>
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
        <a href="/doAn/admin/product/index.php" class="nav-link  text-black" >
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Product Management
        </a>
      </li>
      <li>
        <a href="../../admin/all_orders/manager_orders_customer.php" class="nav-link  text-black" >
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Order management
        </a>
      </li>
      <li>
        <a href="../../admin/chart/chart_money.php" class="nav-link active text-black" style="background-color:#FFFF00;">
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
   <h1 style="text-align:center;">Revenue statistics</h1>
    
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <p><?php echo "Total: ".$sum."$"; ?></p>
    <p><?php echo "Product was bought the most is: ".$row_finally['product_code'].""; ?></p>
        <?php
            // print quantity orders follow month
            for($i = 0; $i < count($quantity_orders); $i++){
                $t = $i + 1;
                ?>
                    <p>
                        <?php echo "Tháng ".$t." có số lượng đơn được đặt là :".$quantity_orders[$i];
                         
                        ?>
                    </p>


                <?php
                
            }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  let person = {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
      datasets: [
    {
        label: 'Revenue',
        data: <?php echo $text_data; ?>//[12, 19, 3, 5, 2, 3, 25],
//         backgroundColor: [
//  "rgba(196, 190, 183)",
//  "rgba(21, 227, 235)",
//  "rgba(7, 150, 245)",
//  "rgba(240, 5, 252)",
//  "rgba(252, 5, 79)",
//  "rgb(0,12,255)",
//  "rgb(17, 252, 5)"],
        borderWidth: 1
        //backgroundColor: ['red','blue','green','yellow','rgb(123,150,255)','rgb(123,150,22)','rgb(123,15,255)']
    }
    
    ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            // text: "Số tiền"
          }
        },
        x: {
          beginAtZero: true,
          title: {
            display: true,
            // text: "Tháng"
          }
        }
      }
    }
  }
  let chart = new Chart(ctx, person);
</script>
   </div>
</body>
</html>