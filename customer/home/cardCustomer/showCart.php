<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "project1";
$port = 3306;
// Create connection
$conn = new mysqli($servername, $username, $password,$db_name,$port);
// print_r($_SESSION['cart']);exit;
if(isset($_SESSION['cart'])){
$array_keys = array_keys($_SESSION['cart']);
$_SESSION['product_id'] = $array_keys;
$max = count($array_keys);
}
else{
//   echo "Chưa có sản phẩm nào trong giỏ";
    // exit;
}

      

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .container {
            display: flex;
        }

        .left {
            width: 70%;
        }

        hr {
            border: 1px solid black;
        }

        .right {
            width: 30%;
            margin-left: 2%;
        }

        .right_1 {
            text-align: center;
            height: auto;
            border: 1px solid black;
        }

        .orange-button {
            width: 90%;
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
        table{
          width: 100%;
        }
        

        table,
        th,
        td {
          text-align:center;
            border: 1px solid black;
            border-collapse: collapse;
            
        }
        td img{
          margin-top:5px;
          margin-bottom:5px;
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
                <img id="home-logo" height="80px" width="80px" src="../logo.png" alt="">
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
                <form action='showCart.php'>
                    <button type='submit' style="background-color: rgb(252,188,56);border: none;" class="btn btn-light"><i class='bx bxs-cart'></i></button>
                </form>
            </div>
        </div>
    </div>

   

    <script>
        document.getElementById("home").onclick = function () {
            location.href = "../home.php";
        };
        document.getElementById("help").onclick = function () {
            location.href = "help.php";
        };
    </script>
    <h2 style="text-align:center;">- My bag -</h2>
    <main class="container mt-5">

        <div class="left">
            <div class="left_1">
                <?php

if (empty($max)) {
    // echo "Giỏ hàng hiện chưa có gì??? Bạn hãy đi lựa chọn sản phẩm phù hợp nào";
    ?>
    <h1>Mau đi mua hàng đi giỏ hàng méo có gì</h1>
    <?php
    exit;   
}
                ?>
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Name Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <?php

$total = 0; // Biến để lưu trữ tổng số tiền

for ($i = 0; $i < $max; $i++) {
    $sql = "SELECT * FROM products WHERE id=$array_keys[$i];";
    
    $result = $conn->query($sql);
    if ($result === false) {
        //  echo "<tr><td colspan='9'>Error: " . $conn->error . "</td></tr>";
        continue;
    }
    
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            ?>

                    <td><img height='100px;' src="../<?php echo $row['image'] ?>" alt="no image"></td>
                    <td>
                        <?php echo $row['name'] ?>
                    </td>
                    <td>
                        <?php echo "<p class='price'>".$row['price']."$</p>";  ?>
                    </td>
                    <td>
                        <a class="fa-solid fa-minus" 
                        onclick="minus()"    href='processAddToCard.php?status=minus&id=<?php echo $array_keys[$i]; ?>'></a>
                       
                        <?php
                        echo "<span id='minus'>";
                            echo $_SESSION['cart'][$array_keys[$i]];
                        echo "</span>";
                        ?>
                        <a class="fa-solid fa-plus"
                             href='processAddToCard.php?status=plus&id=<?php echo $array_keys[$i]; ?>'></a>
                    </td>
                    <td>
                        <?php echo "<p class='price'>". $row['price'] * $_SESSION['cart'][$array_keys[$i]]."$</p>"; ?>
                    </td>
                    <?php 
                        $subtotal = $row['price'] * $_SESSION['cart'][$array_keys[$i]];
                        $total += $subtotal; 
                        
                        ?>
                    <?php
            echo "</tr>";
        }
    }
}
?>


                </table>
            </div>
        </div>
        <div class="right">
            <div class="right_1">
          
                <h3>Total order value :</h3>
                <br>
                <h4>
               <?php 
                $_SESSION['total'] = $total; 
               echo " $total $  ";
               ?>
                </h4>
                <hr>
                <form action='customer_info.php'><button type="submit" class="orange-button mb-4">Check out</button></form>
            </div>
        </div>
    </main>

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
    <script>
    
    function minus(){
        // alert("123");
        let number = document.getElementById('minus').innerHTML;
        let quantity = parseInt(number);
        // alert(quantity);
        if(quantity === 1){
            confirm("Bạn chắc chắn muốn xóa sản phẩm này???");
        }

    }
</script>
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