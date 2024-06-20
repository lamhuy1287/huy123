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
$sql = "SELECT * from customers";
$result = mysqli_query($conn, $sql);

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
       border:1px solid black;
       }
       .right{
        float:right;
        height: auto;
        width: 73%;
        border:2px solid black;
        
       }
       .right p {
        margin-left:20px;
       }
       .right p input{
        border:none;
    }
    .right button {
        margin-left:30px;
        margin-bottom:5px;
    }
       #d1,#d2,#d3{
        display:flex;
        height: 50px;
        text-align:center;
        justify-content: center;
        align-items:center;
        width:100%;
        border:1px solid black;
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
                            echo '<a href = "">';
                            echo $_SESSION["customer_name"];
                            echo "</a>";
                            echo "|";
                            echo '<a href = "../../admin/login_logout/logout.php">';
                            echo 'Logout';
                            echo "</a>";
                            
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
                <img id="home" style="justify-content: center;" height="80px" width="80px" src="logo.png" alt="">
                <button id="home" type="button" class="btn btn-outline-light text-dark btn-page">Home</button>
                <script>
                    document.getElementById("home").onclick = function () {
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
        <div id="d1"><a href="test3.php"><i class='bx bxs-user-account'></i> Thông tin khách hàng</a></div>      
        <div id="d2"><a href="test4.php"><i class='bx bx-cog' ></i> Chỉnh sửa thông tin</a></div>
        <div id="d3"><a href="">logout <i class='bx bx-log-out' ></i></a></div>
    </div>
    <div class="center"></div>
    <div class="right">
        <h1 style="text-align:center;">CHỈNH SỬA THÔNG TIN</h1>
        <br>
        <p>Họ và Tên : <input type="text" placeholder="Hiển thị tên hiện tại"></p>
        <br>
        <p>Số điện thoại : <input type="text" placeholder="hiển thị số điện thoại hiện tại"></p>
        <br>
        <p>Email : <input type="text" placeholder="hiển thị Email hiện tại"></p>
        <br>
        <P>Địa chỉ nhận hàng : <input type="text" placeholder="hiển thị địa chỉ hiện tại"></P>
        <br>
        <button type="submit"  class="btn btn-warning">Lưu</button>
    </div>

</div>


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