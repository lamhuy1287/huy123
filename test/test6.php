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
$sql = "SELECT id,name, image, price FROM products ORDER BY id DESC LIMIT 5";
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


        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
        }

        .col-product {
            border: 1px solid black;
            height: 420px;
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
            height: 55%;
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
    </style>
</head>

<body>

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
        // Thêm thẻ <a> xung quanh tên sản phẩm
                echo "<a href='preview.php?product_id=".$row['id']."' class='name'><b>".$row['name']."</b></a>";  
                echo "<br>";
                echo "<b class='price'>".$row['price']." $</b>"; 
                echo "<form method ='POST' action='preview.php'>";
                $product_id = $row["id"];
                echo "<input name='product_id' value='$product_id' hidden>";
                echo "<button type='submit' class='orange-button'>Add to cart</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </main>

</body>

</html>