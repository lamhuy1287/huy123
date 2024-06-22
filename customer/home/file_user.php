<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";
if(isset($_GET['search'])){
    header("Location:product.php?search=".$_GET['search']);
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
if(!isset($_SESSION["customer_id"])){
     header('location:/DOAN/customer/home/home.php');
}
$id = $_SESSION["customer_id"];
$sql = "SELECT * from customers where id=$id;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            height: 130px;
            width: 100%;
            background-color: rgb(252, 188, 56);
            display: flex;
            flex-direction: column;
            /* Arrange children in a column */
        }

        .header_1 {
            height: 40px;
            width: 100%;
            background-color: aliceblue;
            display: flex;
        }

        .header_2 {
            height: 90px;
            /* Changed height to accommodate the image height */
            width: 100%;
            display: flex;
        }

        .a1,
        .a3 {
            height: 40px;
            width: 25%;
            background-color: rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .a2 {
            height: 40px;
            width: 50%;
            background-color: rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .b1 {
            height: 90px;
            width: 50%;
            display: flex;
            align-items: center;
            /* Center vertically */
            padding-left: 20px;
            /* Add padding to separate items from the left edge */
        }

        .b2 {
            height: 90px;
            width: 50%;
            background-color: rgb(252, 188, 56);
            /* Just for visualization */
            display: flex;
            align-items: center;
            /* Center vertically */
            justify-content: flex-end;
            /* Push buttons to the right */
            padding-right: 60px;
        }


        .btn-login {
            border: none;
        }

        .b1 img {
            margin-right: 20px;
            /* Add margin to separate the image from buttons */
        }

        .btn-page {
            margin-right: 15px;
            /* Add margin between buttons */
            border: none;
            font-size: 20px;
        }

        #search-box {
            background: #fff;
            border-radius: 30px;
        }

        #search-box #search-text {
            border: none;
            outline: none;
            background: none;
            font-size: 15px;
            width: 0;
            padding: 0;
            transition: all 0, 25s ease-in-out;
        }

        #search-box:hover #search-text,
        #search-box #search-text:valid {
            width: 300px;
            padding: 10px 0px 10px 15px;
        }

        #search-btn {
            border: none;
            background-color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 50%;
            font-size: 13px;
        }
       #table{
        margin-top:20px;
        height: auto;
       }
       hr{
        border:1px solid black;
       }
       .center{
        float:center;
        height:auto;
        width: 2%;
       }
       .left{
        
        float:left;
        height:auto;
        width: 25%;
      
       }
       .right {
    float: right;
    height: auto;
    width: 73%;
    border: 2px solid black;
    border-radius:15px;
    display: flex;
    flex-direction: column; /* Added to arrange items vertically */
    padding: 20px; /* Added padding for better spacing */
}
.right p, .right h1 {
    margin-bottom: 10px;
}

.right input {
    width: 100%;
    padding: 5px;
    margin-top: 5px;
}

.right button {
    align-self: flex-start;
}

       .left button {
        border:none;
        background-color:white;
       }
       #btn1,#btn2,#btn3,#btn4{
        display:flex;
        height: 50px;
        text-align:center;
        justify-content: center;
        align-items:center;
        width:100%;
        border-radius:15px;
       }
       button.active {
    background-color: rgb(252, 188, 56); /* Màu nền cho nút active */
    color: white;
    border: none;
}
       .div {
    height: auto;
    width: 100%;
    display: none; /* Hide all divs initially */
    flex-direction: column; /* Ensure contents are arranged vertically */
   
}
#div1{
    display: flex;
    flex-direction: column;
}
        .End {
            display: flex;
            background-color: #e6e6e6;
            height: auto;
            margin-top: 20px;
            margin-left: 10%;
            margin-right: 10%;
        }

        .footer {
            height: auto;
        }
        
        table, th, td{
    border-top:1px solid #ccc;
    border-bottom:1px solid #ccc;
}
table{
    border-collapse:collapse;
}
    </style>
</head>

<body>
    <div class="header">
        <div class="header_1">
            <div class="a1"></div>
            <div class="a2">
                <p>
                    <i class='bx bx-chevron-left'></i>
                    Free ship toàn quốc cho đơn hàng trên 1.000.000 VNĐ
                    <a href="#">Learn more</a>
                    <i class='bx bx-chevron-right'></i>
                </p>
            </div>
            <div class="a3">
                <!-- <a href="../../admin/login_logout/login.php"> -->
                <!-- <button type="button" class="btn btn-outline btn-login" onclick="window.location.href = 'login.html';"> -->
                <i class='bx bxs-user'></i>
                <?php
                        if(isset($_SESSION["admin"])){
                            echo '<a href = "../../admin/manager_admin/showInfo.php">';
                            echo $_SESSION["admin"];
                            echo "</a>";
                            echo "|";
                            echo '<a href = "../../admin/login_logout/logout.php">';
                            echo 'Logout';
                            echo "</a>";
                        }
                        else if(isset($_SESSION["customer_name"])){
                            echo "<a href='file_user.php?id_user=" . $_SESSION['customer_id'] . "' class='user'><b>" . $_SESSION["customer_name"] . "</b></a>";
                          
                            
                        }
                        else{
                            echo '<a style="color:black" href="../../admin/login_logout/login.php">';
                            echo "Login";
                            echo "</a>";
                            // echo "|";
                            // echo '<a href="../registerCustomer/registerCustomer.php">';
                            // echo "Sign up";
                            // echo "</a>";
                        } ?>
                <!-- </button> -->
                <!-- </a> -->
                | Join LEGO® Insiders
            </div>
        </div>
        <div class="header_2">
            <div class="b1">
            <img id="home_1" style="justify-content: center;" height="80px" width="80px" src="logo.png" alt="">
                <script>
                    document.getElementById("home_1").onclick = function () {
                        location.href = "home.php";
                    };
                </script>
                <button id="home_2" type="button" class="btn btn-outline-light text-dark btn-page">Home</button>
                <script>
                    document.getElementById("home_2").onclick = function () {
                        location.href = "home.php";
                    };
                </script>
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-light text-dark btn-page"
                        data-toggle="dropdown">Themes</button>
                    <ul class="dropdown-menu">
                        <li><a href="disney.php">Disney</a></li>
                        <li><a href="friends.php">Friends</a></li>
                        <li><a href="technic.php">Technic</a></li>
                        <li><a href="dreamzzz.php">Dreamzzz</a></li>
                        <li><a href="ninjago.php">NinjaGo</a></li>
                    </ul>
                </div>
                <button id="help" type="button" class="btn btn-outline-light text-dark btn-page">Help</button>
                <script>
                    document.getElementById("help").onclick = function () {
                        location.href = "help.php";
                    };
                </script>
            </div>
            <div class="b2">
                <form action="product.php" id="search-box" method="Get">
                    <input name="search" type="text" id="search-text" placeholder="Tìm kiếm sản phẩm" required>
                    <button id="search-btn"><i class='bx bx-search'></i></button>
                </form>
                <button style="background-color: rgb(252,188,56);border: none;" type="button" class="btn btn-light"><i
                        class='bx bxs-cart'></i></button>
            </div>
        </div>
    </div>

    <div class="container" id="table">
    <div class="left">
        <button id="btn1" class="active" onclick="showDiv('div1', 'btn1')">Thông tin khách hàng</button>
        <br>      
        <button id="btn2" onclick="showDiv('div2', 'btn2')">Chỉnh sửa thông tin khách hàng</button>
        <br>
        <button id="btn3" onclick="showDiv('div3', 'btn3')">Lịch sử mua hàng</button>
        <br>
        <form action='../../admin/login_logout/logout.php'><div id="btn4"><button>Đăng xuất</button></div></form>
    </div>
    <div class="center"></div>
    <div class="right">
       
        <div class="div" id="div1">
            <h1 style="text-align: center;">THÔNG TIN KHÁCH HÀNG</h1>
            <hr style="width:60%;margin-left:20%;margin-right:20%;">
            <p><b>Họ và Tên:</b> <?php echo $row['name']; ?></p>
            <br>
            <p><b>Số điện thoại:</b> <?php echo $row['phone']; ?></p>
            <br>
            <p><b>Email:</b> <?php echo $row['email']; ?></p>
            <br>
            <p><b>Địa chỉ nhận hàng:</b> <?php echo $row['address']; ?></p>
        </div>
        <div class="div " id="div2">
            <form action="../update_customer/processUpdateCustomer.php" method='post'>
                <h1 style="text-align: center;">CHỈNH SỬA THÔNG TIN</h1>
                <hr style="width:60%;margin-left:20%;margin-right:20%;">
                <p><b>Họ và Tên:</b> <input name="name" type="text" value="<?php echo $row['name']?>" placeholder="Full Name"></p>
                <br>
                <p><b>Số điện thoại:</b> <input name="phone" value="<?php echo $row['phone']?>" type="text" placeholder="Phone Number"></p>
                <br>
                <p><b>Email:</b> <input name="email" type="text" value="<?php echo $row['email']?>" placeholder="Gmail"></p>
                <br>
                <p><b>Địa chỉ nhận hàng:</b> <input name="address" value="<?php echo $row['address']?>" type="text" placeholder="Address"></p>
                <br>
                <button type="submit" class="btn btn-warning">Cập nhật</button>
            </form>
        </div>
        <div class="div " id="div3">
            <h1 style="text-align: center;">LỊCH SỬ MUA HÀNG</h1>
            <hr style="width:60%;margin-left:20%;margin-right:20%;">
            <?php


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


    <table >
        <tr  >
            <th style="text-align:center;">Địa chỉ nhận hàng</th>
            <th style="text-align:center;">Trạng thái đơn hàng</th>
            <th style="text-align:center;">Thời gian đặt hàng</th>
            <th style="text-align:center;">Tổng tiền</th>
            <th style="text-align:center;">Chi tiết</th>
            
        </tr>
        
            <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                     ?>
                        
                        <td style="width:40%;text-align:center;"><?php echo $row['customer_address'] ?></td>
                        <td style="width:15%">
                        
                           <?php  
                             $data = $row['order_id'];
                             
                             if($row['order_status'] == 0){
                               echo "<p style='text-align:center;color:blue'>"."Đang chờ duyệt"."</p>";
                             }
                             else if($row['order_status'] == 1){
                                echo "<p style='color:orange;text-align:center;'>"."Đang giao"."</p>";
                             }
                             else if($row['order_status'] == 2){
                                echo "<p style='text-align:center;color:green'>"."Giao hàng thành công"."</p>";
                             }
                             else{
                                echo "<p style='text-align:center;color:red'>"."Đơn hàng đã bị hủy"."</p>";;
                             }
                        
                            ?>
                          
                        </td>
                        <td style="width:15%;text-align:center;"><?php echo date("Y-m-d", $row['created_at']); ?></td>
                        <td style="width:15%;text-align:center;"><?php echo $row['total'] ?>$</td>
                        <td style="width:15%;text-align:center;"><form action='../order_customer/order_detail_customer.php' method='post'>
                            <button class="btn btn-success">Chi tiết</button>
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


        </div>
    </div>
</div>

<script>
function showDiv(divId, btnId) {
    // Ẩn tất cả các div
    var divs = document.getElementsByClassName('div');
    for (var i = 0; i < divs.length; i++) {
        divs[i].style.display = 'none';
    }
    // Hiển thị div được chọn
    document.getElementById(divId).style.display = 'block';

    // Xóa lớp "active" từ tất cả các nút
    var buttons = document.querySelectorAll('.left button');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('active');
    }
    // Thêm lớp "active" vào nút được chọn
    document.getElementById(btnId).classList.add('active');
}

    </script>

    <div class="End">
        <p style="margin-left: 30px;margin-right: 30px;text-align: center;justify-content: center;">Welcome to the
            Official LEGO® Shop, the amazing home of LEGO building toys, gifts, stunning display sets and more for kids
            and adults alike. Find the perfect gift for toddlers, kids, teens and adults for birthdays or other
            occasions such as Valentine's Day, Mother's Day and Father's Day. We make it easy to shop for toys that will
            provide hours of fun and imaginative play. You’ll also find curated LEGO sets for adults perfectly matching
            their interests, such as cars, flowers, gaming and much more!
        </p>
    </div>
    <br>
</body>
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

</html>