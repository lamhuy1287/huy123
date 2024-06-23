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
$sql = "SELECT id,name, image, price FROM products  ORDER BY id DESC LIMIT 5";
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
            display: flex;
            flex-direction: column;
            width: 100%;
            
        }
        .header_1, .header_2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            width: 100%;
            
        }
        .header_1 {
            background-color: #f8f9fa;
        }
        
        .a1, .a3 {
            display: flex;
            align-items: center;
        }
        .a2 p {
            display: flex;
            align-items: center;
            margin: 0;
            text-align:center;
        }
        .a2 p i, .a2 p a {
            margin: 0 5px;
        }
        .header_2 {
            background-color: rgb(252, 188, 56);
        }
        .b1 {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: rgb(252, 188, 56);
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-menu li a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-menu li a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .b2 {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: rgb(252, 188, 56);
        }
        .b1 .b2 {
            flex: 1; /* Allow these sections to grow and shrink */  
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

        .banner {
            position: relative;
        }
        .banner img {
            width: 100%;
        }
        .banner a {
            position: absolute;
            top: 90%;
            right: 70px;
            transform: translateY(-50%);
            background-color: rgb(252,188,56);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }


        .content {
            margin-top:3%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px; /* Khoảng cách giữa các cột */
            margin-left:5%;
            margin-right:5%;
        }
        .column {
            background-color: rgb(252,188,56);
            flex: 1 1 calc(16.66% - 10px); /* Tính toán chiều rộng của cột */
            text-align: center;
            margin-bottom: 10px; /* Khoảng cách giữa các hàng khi xuống dòng */
        }
        .column a {
            display: block;
            padding: 20px;
            text-decoration: none;
            color: black;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
        }

        .col-product {
            border: 1px solid black;
            height: auto;
            width: calc(20% - 16px);
            /* Adjusted to fit 5 products in a row */
            margin-top: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .col-product hr {
            width: 100%;
            border: 1px solid black;
        }

        .col-product img {
            height: 100%;
            display: block;
            margin: auto;
        }

        .col-product .name {
            display: flex;
            font-size: 14px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .col-product .price {
            display: flex;
            font-size: 16px;
            justify-content: center;
            align-items: center;
        }

        .orange-button {
            width: auto;
            background-color: orange;
            border: 1px solid orange;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
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

        @media (max-width: 1200px) {
            .col-product {
                width: calc(25% - 16px);
                /* 4 products in a row */
            }
        }

        @media (max-width: 992px) {
            .col-product {
                width: calc(33.333% - 16px);
                /* 3 products in a row */
            }
        }

        @media (max-width: 768px) {
            .col-product {
                width: calc(50% - 16px);
                /* 2 products in a row */
            }
        }

        @media (max-width: 576px) {
            .col-product {
                width: 100%;
                /* 1 product in a row */
            }
        }

        .container_1 {
            display: flex;
            justify-content: space-between;
            width: auto;
            margin: 0 auto;
        }

        /* CSS cho mỗi cột */
        .column_1 {
            width: 100%;
            /* Phân chia chiều rộng cho mỗi cột */
            background-color: #f2f2f2;
            padding: 10px;
        }

        /* CSS cho hình ảnh */
        .image {
            width: 100%;
            height: auto;
        }

        /* CSS cho tiêu đề */
        .title {
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        /* CSS cho phần giới thiệu */
        .description {
            text-align: center;
            margin-top: 5px;
        }

        .container_3 {
            height: auto;
            /* Độ cao của div container */
            display: flex;
            /* Sử dụng flexbox để dễ dàng chia layout */
            background-color: black;
            position: relative;
        }

        .container_3 img {
            width: 100%;
            height: auto;
        }

        .text-container {

            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
            /* Đảm bảo văn bản nằm giữa ngang */
        }

        .text-container h3 {

            margin: 0;
            /* Loại bỏ margin mặc định */
            color: white;
            /* Màu văn bản */
            font-family: "Times New Roman", Times, serif;
            font-weight: bold;
            /* Đậm */
            text-transform: uppercase;
            /* Chuyển đổi văn bản thành chữ in hoa */
        }

        .text-container h4 {
            margin: 0;
            /* Loại bỏ margin mặc định */
            color: white;
            /* Màu văn bản */
            font-family: "Times New Roman", Times, serif;
            font-weight: bold;
            /* Đậm */
            text-transform: uppercase;
            /* Chuyển đổi văn bản thành chữ in hoa */
        }

        .text-container h2 {
            margin: 0;
            /* Loại bỏ margin mặc định */
            color: white;
            /* Màu văn bản */
            font-family: "Times New Roman", Times, serif;
            font-weight: bold;
            /* Đậm */
            text-transform: uppercase;
            /* Chuyển đổi văn bản thành chữ in hoa */
        }

        .text-container p {
            margin: 0;
            /* Loại bỏ margin mặc định */
            color: white;
            /* Màu văn bản */
            font-family: "Times New Roman", Times, serif;
            text-transform: uppercase;
            /* Chuyển đổi văn bản thành chữ in hoa */
        }

        .container_4 {
            display: flex;
            height: auto;
        }

        .column_4 {
            flex: 1;
            /* Thêm viền để phân biệt các cột */
            padding: 10px;
            /* Thêm khoảng cách nội dung từ viền */
            text-align: center;
            /* Canh giữa nội dung trong cột */
            margin: 0 10px;
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
                <p >
                    <i class='bx bx-chevron-left'></i>
                    LEGO® Insiders gift with purchases of £135 or more*
                    <a href="#">Learn more</a>
                    <i class='bx bx-chevron-right'></i>
                </p>
            </div>
            <div class="a3">
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
                        } ?>
                | Join LEGO® Insiders
            </div>
        </div>
        <div class="header_2">
            <div class="b1">
                <img id="home-logo" height="80px" width="80px" src="logo.png" alt="">
                <button id="home" type="button" class="btn btn-outline-light text-dark btn-page">Home</button>
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-light text-dark btn-page" data-toggle="dropdown">Themes</button>
                    <ul class="dropdown-menu">
                        <li><a href="disney.php">Disney</a></li>
                        <li><a href="friends.php">Friends</a></li>
                        <li><a href="technic.php">Technic</a></li>
                        <li><a href="dreamzzz.php">Dreamzzz</a></li>
                        <li><a href="ninjago.php">NinjaGo</a></li>
                    </ul>
                </div>
                <button id="help" type="button" class="btn btn-outline-light text-dark btn-page">Help</button>
            </div>
            <div class="b2">
                <form action="product.php" id="search-box" method="get">
                    <input name="search" type="text" id="search-text" placeholder="Search..." required>
                    <button id="search-btn"><i class='bx bx-search'></i></button>
                </form>
                <form action='./cardCustomer/showCart.php'>
                    <button type='submit' style="background-color: rgb(252,188,56);border: none;" class="btn btn-light"><i class='bx bxs-cart'></i></button>
                </form>
            </div>
        </div>
    </div>

   

    <script>
        document.getElementById("home").onclick = function () {
            location.href = "home.php";
        };
        document.getElementById("help").onclick = function () {
            location.href = "help.php";
        };
    </script>

<div class="banner">
        <img src="https://collider.com/wp-content/uploads/2017/09/lego-ninjago-movie-illustration-banner.jpg" alt="">
        <a href="ninjago.php">See More</a>
    </div>
    <div class="content">
        <!-- Cột 1 -->
        <div style="background-color: rgb(252,188,56);" class="column">
            <a href="new.php">New</a>
        </div>

        <!-- Cột 2 -->
        <div style="background-color: rgb(252,188,56);" class="column">
            <a href="technic.php">Technic</a>
        </div>

        <!-- Cột 3 -->
        <div style="background-color: rgb(252,188,56);" class="column">
            <a href="disney.php">Disney</a>
        </div>

        <!-- Cột 4 -->
        <div style="background-color: rgb(252,188,56);" class="column">
            <a href="hero.php">Hero</a>
        </div>

        <!-- Cột 5 -->
        <div style="background-color: rgb(252,188,56);" class="column">
            <a href="dreamzzz.php">DREAMZzz™</a>
        </div>

        <!-- Cột 6 -->
        <div style="background-color: rgb(252,188,56);" class="column">
            <a href="ninjago.php">NINJAGO®</a>
        </div>


    </div>
    <br>
    <p style="font-size: 30px;margin-left: 35px;">New sets :</p>
    <main class="container">
        <div class="product-container">
            <?php
            while ($row = mysqli_fetch_assoc($result)){
                echo "<div class='col-product'>";
                echo "<a href='preview.php?product_id=".$row['id']."'>";
                echo "<img class='img-fluid' src='".$row['image']."' alt='".$row['name']."'/>";
                echo "</a>";
                echo  "<hr style='border:1px solid black;'>";
                echo "<a href='preview.php?product_id=".$row['id']."' class='name'><b>".$row['name']."</b></a>";  
                echo "<br>";
                echo "<b class='price'>".$row['price']." $</b>"; 
                $product_id = $row["id"];
                echo "<form method ='POST' action='./cardCustomer/processAddToCard.php'>";
                echo "<input name='product_id_cart' value='$product_id' hidden>";
                echo "<input name='old_url' value='".$_SERVER['REQUEST_URI']."' hidden>";
                echo "<button style='margin-left:4px;' type='submit' class='orange-button'>Add To Card</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </main>


    <br>
    <p style="font-size: 30px;margin-left: 35px;">This week's top picks :</p>
    <div class="container_1">
        <!-- Cột 1 -->
        <div class="column_1">
            <img class="image"
                src="https://www.lego.com/cdn/cs/set/assets/blt27ac7acf67523393/76271-Exclusive-202404-Block-Standard-3.jpg?fit=crop&format=webply&quality=80&width=635&height=440&dpr=1.5"
                alt="Image 1">
            <div class="title">
                <p>New Batman: The Animated </p>
                <p>Series Gotham City™</p>
            </div>
            <div class="description">
                <p>Illuminate an icon with this spectacular new cityscape.</p>

            </div>
        </div>

        <!-- Cột 2 -->
        <div class="column_1">
            <img class="image"
                src="https://www.lego.com/cdn/cs/set/assets/blt97165949f6e35edc/21348-Exclusive-202404-PDP-GameNight-Block-Standard.jpg?fit=crop&format=webply&quality=80&width=635&height=440&dpr=1.5"
                alt="Image 2">
            <div class="title">
                <p>New Dungeons & Dragons:</p>
                <p> Red Dragon’s Tale</p>
            </div>
            <div class="description">
                <p>Build an adventure like never before</p>

            </div>
        </div>

        <!-- Cột 3 -->
        <div class="column_1">
            <img class="image"
                src="https://www.lego.com/cdn/cs/set/assets/blt7ab5668500f26d43/10332-Homepage-202403-Block-Standard.jpg?fit=crop&format=webply&quality=80&width=635&height=440&dpr=1.5"
                alt="Image 3">
            <div class="title">
                <p>New Medieval Town Square</p>
            </div>
            <div class="description">
                <p>New Medieval Town Square</p>

            </div>
        </div>
    </div>
    <br>
    <p style="font-size: 30px;margin-left: 35px;">Spotlight on…</p>
    <div class="container_3">

        <img src="https://www.lego.com/cdn/cs/set/assets/blt684048c4fb6edf33/21348-Exclusive-202404-Homepage-SL-Hero-Standard-Large.jpg?fit=crop&format=webply&quality=80&width=1600&height=500&dpr=1.5"
            alt="">
        <div class="text-container">
            <h3>Dungeons</h3>
            <h4>& Dragon</h4>
            <br>
            <h2>Build an adventure like </h2>
            <h2>never before</h2>
            <br>
            <p>Start an epic quest with new Dungeons & Dragons:</p>
            <p>Red Dragon’s Tale.</p>

        </div>
    </div>
    <br>
    <div>
        <h4 style="text-align: center;font-size: 30px;">Find inspiration, share your creation</h4>
        <p style="text-align: center;">Post your photos to Instagram and mention @LEGO in the caption for a chance to be
            featured on the</p>
        <p style="text-align: center;">website and shop the sets you like below.</p>
    </div>
    <br>
    <div class="container_4">
        <div class="column_4"><img class="image"
                src="https://www.lego.com/cdn/cs/set/assets/blteb6d782e63fd9de2/10280_Block_Standard_3.jpg?fit=crop&format=jpg&quality=80&width=635&height=440&dpr=1"
                alt=""></div>
        <div class="column_4"><img class="image"
                src="https://www.lego.com/cdn/cs/set/assets/bltba80026c04e00dd2/240123_Design_brief_Article_assets_Roots_Card_Content.jpg?fit=crop&format=webply&quality=80&width=635&height=440&dpr=1.5"
                alt=""></div>
        <div class="column_4"><img class="image"
                src="https://www.mykingdom.com.vn/cdn/shop/articles/mykingdom-do-choi-lap-rap-lego-creator-image.jpg?v=1686020279"
                alt=""></div>
        <div class="column_4"><img class="image"
                src="https://www.lego.com/cdn/cs/set/assets/blta36ab46b5a372960/HERO_Mobile.jpg?fit=crop&format=webply&quality=80&width=635&height=440&dpr=1.5"
                alt=""></div>
        <br>
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

                    <h3>Contact</h3>
                    <p>Address:Phú Diễn , Bắc Từ Liêm ,Hà Nội</p>
                    <p>Email: lamhuy26@gmail.com</p>
                    <p>Phone number: 0377006359</p>
                </div>
                <div class="col">
                    <h3>Link</h3>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="new.php">Products</a></li>
                        <li><a href="https://www.messenger.com/e2ee/t/6948976355124079">Contact help</a></li>
                        <!-- Thêm các liên kết khác -->
                    </ul>
                </div>
                <div class="col">
                    <h3>Map</h3>
                    <div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14894.008647910136!2d105.75368688691543!3d21.052596739639352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454dc9b34f767%3A0xd6b847b3f4d5a4a0!2zUGjDuiBEaeG7hW4sIELhuq9jIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1711990425983!5m2!1svi!2s"
                            width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

</html>