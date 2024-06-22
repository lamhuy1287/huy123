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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    * {
            box-sizing: border-box;
        }

        .header {
            display: flex;
            flex-direction: column;
            width: 100%;
            
        }
         .header_2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            width: 100%;
       
            background-color: rgb(252, 188, 56);
            height: 80px;
           
        }
        #b1{
          width: 30%;
          font-size:18px;
        }
        #b2{
          width: 40%;
         
          display: flex;
  justify-content: center;
  align-items: center;
        }
        
        #b3{
          width: 30%;
         
        }

.footer {
            height: auto;
        }
        table, th, td{
    border:1px solid #868585;
}
table{
    border-collapse:collapse;
    
    
}
table tr:nth-child(odd){
    background-color:#eee;
}
table tr:nth-child(even){
    background-color:white;
}
table tr:nth-child(1){
    background-color:rgb(252, 188, 56);
}
  </style>
</head>
<body>
<div class="header">
        <div class="header_2">
        <div id="b1">< <a href="../home/file_user.php" style="color:black;">Back </a></div>
          <div id="b2">
          <img id="home_1"  height="70px" width="70px" src="../home/logo.png" alt="">
                <script>
                    document.getElementById("home_1").onclick = function () {
                        location.href = "../home/home.php";
                    };
                </script>
          </div>
          <div id="b3"></div>
            
        </div>
    </div>
    
    <h1 style="text-align:center;">CHI TIẾT ĐƠN HÀNG</h1>
    <br>
    <div class="container">
    <table style="width:100%;">
        <tr>
            <th style="text-align:center;">Mã sản phẩm</th>
            <th style="text-align:center;">Số lượng</th>
            <th style="text-align:center;">Tên sản phẩm</th>
            <th style="text-align:center;">Giá</th>
            <th style="text-align:center;">Thể loại</th>
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
                            <td style="text-align:center;"><?php echo $row['product_id']; ?></td>
                            <td style="text-align:center;"><?php echo $row['product_quantities']; ?></td>
                            <td style="text-align:center;"><?php echo $row_new['name']; ?></td>
                            <td style="text-align:center;"><?php echo $row_new['price']; ?>$</td>
                            <td style="text-align:center;"><?php echo $row_new['themes']; ?></td>
                        <?php
                        echo "</tr>";
                    }
                  } else {
                    echo "0 results";
                  }


            ?>
    </table>
    </div>
    <br>
<div class="footer">
        <hr style="border:1px solid black;">
        <br>
        <div class="container" style="background-color:white;row row-cols-3">
            <div class="row w-100">
                <div class="col">

                    <h3>Liên hệ</h3>
                    <p>Địa chỉ:Phú Diễn , Bắc Từ Liêm ,Hà Nội</p>
                    <p>Email: lamhuy26@gmail.com</p>
                    <p>Điện thoại: 0377006359</p>
                </div>
                <div class="col">
                    <h3>Liên kết</h3>
                    <ul>
                        <li><a href="home.php">Trang chủ</a></li>
                        <li><a href="new.php">Sản phẩm</a></li>
                        <li><a href="https://www.messenger.com/e2ee/t/6948976355124079">Liên hệ hỗ trợ</a></li>
                        <!-- Thêm các liên kết khác -->
                    </ul>
                </div>
                <div class="col">
                    <h3>Bản đồ</h3>
                    <div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14894.008647910136!2d105.75368688691543!3d21.052596739639352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454dc9b34f767%3A0xd6b847b3f4d5a4a0!2zUGjDuiBEaeG7hW4sIELhuq9jIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1711990425983!5m2!1svi!2s"
                            width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>