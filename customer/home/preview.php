<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
} elseif (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} else {
    echo "No product ID provided.";
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin sản phẩm được chọn
$sql_product = $conn->prepare("SELECT id,product_code, name, price, description, image, themes FROM products WHERE id = ?");
$sql_product->bind_param("i", $product_id);
$sql_product->execute();
$result_product = $sql_product->get_result();

$product = $result_product->fetch_assoc();
if (!$product) {
    echo "Product not found.";
    exit();
}

$product_theme = $product['themes'];

// Lấy 5 sản phẩm có cùng themes với sản phẩm được chọn
$sql_related_products = $conn->prepare("SELECT id, product_code, name, price, image FROM products WHERE themes = ? AND id != ? LIMIT 5");
$sql_related_products->bind_param("si", $product_theme, $product_id);
$sql_related_products->execute();
$result_related_products = $sql_related_products->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
       *{
            box-sizing: border-box;
        }
        body{
            background-color:#F5F5F5;
        }
        .header {
            height: 130px;
            width: 100%;
            background-color: rgb(252,188,56);
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
            background-color:rgb(252,188,56);
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
        #search-box{
            background: #fff;
            border-radius: 30px;
        }
        #search-box #search-text{
            border: none;
            outline: none;
            background: none;
            font-size: 15px;
            width: 0;
            padding: 0;
            transition: all 0,25s ease-in-out;
        }
        #search-box:hover #search-text,#search-box #search-text:valid{
            width: 300px;
            padding: 10px 0px 10px 15px;
        }
        #search-btn{
            border: none;
            background-color: white;
            cursor: pointer;
            padding:15px;
            border-radius: 50%;
            font-size: 13px;
        }
        
        .container {
            display: flex;
            flex-wrap: wrap;
            background-color: white;
            padding: 20px;
        }
        .left, .right {
            flex: 1;
            min-width: 300px; /* Ensure a minimum width for better responsiveness */
            padding: 10px;
        }
        .custom-image {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .btn-dark {
            width: 100%;
            color: white;
        }
        .product {
            width: 18%;
            background-color: white;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid black;
            padding: 20px;
            border-radius: 10px;
            margin-right: 10px;
        }
        .product img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 5px;
        }
        .name, .price, .product_code {
            margin-top: 10px;
        }
        .orange-button {
            width: 100%;
            background-color: orange;
            border: 2px solid orange;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            transition: background 0.3s, color 0.3s;
        }
        .orange-button:hover {
            background-color: white;
            color: orange;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left, .right {
                width: 100%;
            }
            .product {
                width: 100%;
            }
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
 
  
  .End {
            display:flex;
            background-color: #e6e6e6;
            height: auto;
            margin-top:20px;
            margin-left: 10%;
            margin-right: 10%;
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
            <i class='bx bxs-user'></i> <?php
                        if(isset($_SESSION["admin"])){
                            echo '<a href = "../../admin/manager_admin/showInfo.php">';
                            echo $_SESSION["admin"];
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
    <button type="button" class="btn btn-outline-light text-dark btn-page"  data-toggle="dropdown">Themes</button>
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
                <form action="" id="search-box">
                    <input type="text" id="search-text" placeholder="Tìm kiếm sản phẩm" required>
                    <button id="search-btn"><i  class='bx bx-search'></i></button>
                </form>
                <form action='./cardCustomer/showCart.php'>
                    <button type='submit' style="background-color: rgb(252,188,56);border: none;" type="button" class="btn btn-light"><i
                            class='bx bxs-cart'></i></button>
                </form>
            </div>
        </div>
</div>
<br>
<br>
<div class="container">
    <div class="left">
        <?php
        if ($result_product) {
            echo "<img class='custom-image' src='" . $product['image'] . "' alt='" . $product['name'] . "'/>";
        }
        ?>
    </div>

    <div class="right">
        <div class="col">
            <?php
            if ($result_product) {
                echo "<h1 class='name'>". $product['name'] . "</h1>";
                echo "<br>";
                echo "<h3>Themes: ". $product['themes'] . "</h3>";
                echo "<br>";
                echo "<h3 class='product_code'>Mã sản phẩm: #" . $product['product_code'] . "</h3>";
                echo "<br>";
                echo "<h3 class='price'>Giá sản phẩm: " . $product['price'] . "$</h3>";
                echo "<br>";
                echo "<br>";
                echo "<form method ='POST' action='./cardCustomer/processAddToCard.php'>";
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
    </div>
</div>
<br>
<h2 style="text-align:center;">Description</h2>
<div class="container">
    <hr>
    <div class="row">
        <div class="col">
            <?php
            if ($result_product) {
                echo "<h5 class='description'>" . $product['description'] . "</h5>";
            }
            ?>
        </div>
    </div>
    <hr>
</div>
<br>
<h2 style="text-align:center;">Sản phẩm tương ứng</h2>
<main class="container">
        <div class="product-container">
<?php
if ($result_related_products) {
    while ($related_product = mysqli_fetch_assoc($result_related_products)) {
        echo "<div class='col-product mt-3 mb-3'>";
                echo "<a href='preview.php?product_id=".$related_product['id']."'>";
                echo "<img class='img-fluid' src='".$related_product['image']."' alt='".$related_product['name']."'/>";
                echo "</a>";
                echo  "<hr style='border:1px solid black;'>";
        // Thêm thẻ <a> xung quanh tên sản phẩm
                echo "<a href='preview.php?product_id=".$related_product['id']."' class='name'><b>".$related_product['name']."</b></a>";  
                echo "<br>";
                echo "<b class='price'>".$related_product['price']." $</b>"; 
                $product_id = $related_product["id"];
                echo "<form method ='POST' action='./cardCustomer/processAddToCard.php'>";
                echo "<input name='product_id_cart' value='$product_id' hidden>";
                echo "<button style='margin-left:4px;' type='submit' class='orange-button'>Add To Card</button>";
                echo "</form>";
                echo "</div>";
    }
}
?>
</div>
    </main>

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
<footer >
    <hr style="border:1px solid black;">
<br>
        <div class="container" style="background-color:#F5F5F5;row row-cols-3">
            <div class="row w-100">
                <div class="col" >
                    
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
                        <li><a href="https://www.facebook.com/profile.php?id=100056716461282">Giới thiệu</a></li>
                        <!-- Thêm các liên kết khác -->
                    </ul>
                </div>
                <div class="col">
        <h3>Bản đồ</h3>
    <div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14894.008647910136!2d105.75368688691543!3d21.052596739639352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454dc9b34f767%3A0xd6b847b3f4d5a4a0!2zUGjDuiBEaeG7hW4sIELhuq9jIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1711990425983!5m2!1svi!2s" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
     </div>      
</footer>
</html>