<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
// Determine the current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Number of items per page
$items_per_page = 12;

// Calculate the offset
$offset = ($current_page - 1) * $items_per_page;

if(isset($_GET["search"])){
    $search= $_GET["search"];
    $sql = "SELECT id, name, image, price FROM products WHERE name LIKE '%$search%' OR product_code LIKE '%$search%' OR themes LIKE '%$search%' LIMIT $offset, $items_per_page";
} else {
    $sql = "SELECT id, name, image, price FROM products  Where themes='ninjago' ORDER BY id DESC LIMIT $offset, $items_per_page";
}

$result = mysqli_query($conn, $sql);

// Get total number of rows
$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM products Where themes='ninjago'"));

// Calculate total pages
$total_pages = ceil($total_rows / $items_per_page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New</title>
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

        #c1 {
            display: flex;
            background-color: black;
            height: 70px;
            color: white;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        h4 {
            text-align: center;
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
            width: calc(25% - 16px);
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
            height: 10%;
            font-size: 14px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .col-product .price {
            display: flex;
            height: 10%;
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
                width: calc(33.333% - 16px);
            }
        }

        @media (max-width: 992px) {
            .col-product {
                width: calc(50% - 16px);
            }
        }

        @media (max-width: 576px) {
            .col-product {
                width: 100%;
            }
        }

        .End {
            background-color: #e6e6e6;
            height: auto;
            margin-left: 70px;
            margin-right: 70px;

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
                <i class='bx bxs-user'></i>
                <?php
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
                <form id="search-box">
                    <input type="text" id="search-text" name="search" placeholder="Tìm kiếm sản phẩm thuộc Disney"
                        required>
                    <button id="search-btn"><i class='bx bx-search'></i></button>
                </form>
                <form action='./cardCustomer/showCart.php'>
                    <button type='submit' style="background-color: rgb(252,188,56);border: none;" type="button" class="btn btn-light"><i
                            class='bx bxs-cart'></i></button>
                </form>
            </div>
        </div>
    </div>

    <div id="c1">
        <h2>NINJAGO</h2>
        <br>
    </div>
    <br>
    <?php
    // Thực hiện truy vấn SQL để tính tổng số lượng sản phẩm
    $total_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total_count FROM products");
    $total_count_row = mysqli_fetch_assoc($total_count_query);
    $total_count = $total_count_row['total_count'];

    // Hiển thị số lượng sản phẩm
    echo "<h4>Showing " . mysqli_num_rows($result)  . " products</h4>";
    ?>
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
               echo "<input name='old_url' value='".$_SERVER['REQUEST_URI']."' hidden>";
               echo "<input name='product_id_cart' value='$product_id' hidden>";
               echo "<button style='margin-left:4px;' type='submit' class='orange-button'>Add To Card</button>";
               echo "</form>";
               echo "</div>";
           }
           ?>
            
        </div>
    </main>
    <br>
    <!-- Pagination -->
    <nav aria-label="Page navigation" class="d-flex justify-content-center">
        <ul class="pagination">
            <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
            <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $page; ?>">
                    <?php echo $page; ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <br>
    <div class="End">
        <p style="margin-left: 30px;margin-right: 30px;text-align: center;justify-content: center;align-items:center;">
            Welcome to the
            Official LEGO® Shop, the amazing home of LEGO building toys, gifts, stunning display sets and more for kids
            and adults alike. Find the perfect gift for toddlers, kids, teens and adults for birthdays or other
            occasions such as Valentine's Day, Mother's Day and Father's Day. We make it easy to shop for toys that will
            provide hours of fun and imaginative play. You’ll also find curated LEGO sets for adults perfectly matching
            their interests, such as cars, flowers, gaming and much more!
        </p>
    </div>
    <br>
</body>
<footer>
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
                    <li><a href="https://www.facebook.com/profile.php?id=100056716461282">Giới thiệu</a></li>
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
</footer>
</body>

</html>