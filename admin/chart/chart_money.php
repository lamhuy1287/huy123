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