<?php
session_start();
// show info of customer
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
$id = $_SESSION["customer_id"];
$sql = 'select * from customers where id='.$id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  $customer_name = $row['name'];
  $customer_phone = $row['phone'];
  $customer_address = $row['address'];
} else {
  echo "0 results";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>Checkout</title>
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
        .container {
  display: flex;
  flex-wrap: wrap;
  height: auto;
}

.delivery_payment {
  width: 55%;
  padding: 20px;
  height: auto;
  
}

.summary_orderDetails {
  width: 45%;
  padding: 20px;
  height: auto;
  
}
.orange-button {
            width: auto;
            background-color: orange;
            border: 1px solid orange;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: flex;
            font-size: 14px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 8px;
            transition: background 0.3s, color 0.3s;
            
            
        }

        .orange-button:hover {
            background-color: white;
            color: orange;
        }
.footer {
            height: auto;
        }

  </style>
</head>
<body>
<div class="header">
        <div class="header_2">
        <div id="b1">< <a href="showCart.php" style="color:black;">Back to my bag</a></div>
          <div id="b2">
          <img id="home_1"  height="70px" width="70px" src="../logo.png" alt="">
                <script>
                    document.getElementById("home_1").onclick = function () {
                        location.href = "../home.php";
                    };
                </script>
          </div>
          <div id="b3"></div>
            
        </div>
        <br>
    </div>
    <div class="container">
  <div class="delivery_payment" id="delivery_payment">
  <h2><b>Thông tin nhận hàng :</b></h2>
  <hr style="border:1px solid black;">
  <form action='processOrders.php' method='post'>
    <label for="">Tên người nhận :</label>
    <br>
    <input name='customer_name' type="text" placeholder='Customer Name' value='<?php echo $customer_name ?>'>
    <br>
    <br>
    <label for="">Số điện thoại người nhận :</label>
    <br>
    <input name='customer_phone' type="number" placeholder='Phone Number' value='<?php echo $customer_phone; ?>'>
    <br>
    <br>
    <label for="">Địa chỉ nhận hàng :</label>
    <br>
    <input style="width:100%;" name='customer_address' type="text" placeholder='Customer Address' value='<?php echo $customer_address; ?>'>
    <br>
    <br>
    <button type='submit'class="orange-button">Xác nhận mua hàng</button>
    </form>
  </div>
  <div class="summary_orderDetails" id="summary_orderDetails">
    <h2><b>Tổng thanh toán :</b></h2>
    <hr style="border:0.5px solid black;width:50%">
    <p><b>Tổng tiền sản phẩm :<?php echo $_SESSION['total']."$"; ?></b></p>
    <br>
    <p><b>Phí ship : 1$</b></p>
    <br>
    <p><b>Hình thức thanh toán : COD </b></p>
    <br>
    <p><b>Thuế VAT : Đã đước tính vào giá sản phẩm !</b></p>
    <br>


  </div>
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