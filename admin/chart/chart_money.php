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
</head>
<body>
    <h1>Doanh số Năm 2024</h1>
    
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  let person = {
    type: 'bar',
    data: {
      labels: ['tháng 1', 'tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
      datasets: [
    {
        label: 'Doanh thu',
        data: <?php echo $text_data; ?>//[12, 19, 3, 5, 2, 3, 25],
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
            text: "Số tiền"
          }
        },
        x: {
          beginAtZero: true,
          title: {
            display: true,
            text: "Tháng"
          }
        }
      }
    }
  }
  let chart = new Chart(ctx, person);
</script>
</body>
</html>