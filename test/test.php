<?php
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
$sql = "SELECT id,name, image, price FROM products ORDER BY id DESC LIMIT 4";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .product {
            width: 18%;
            background-color: white;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid black;
            padding: 20px;
            border-radius: 10px;
        }
        .product img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 5px;
        }
        .price {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }
        .custom-button {
            background-color: orange;
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            outline: none;
        }
        .custom-button:hover {
            background-color: #ffcc80;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            echo "<div class='product'>";
            echo "<img  class='img-fluid' src='".$row['image']."'/>";
            echo "<hr>";
            echo "<td>".$row['name']."</td>";
            echo "<br>";
            echo "<td style='text-align:center;'>".$row['price']." $</td>";
            echo "<form method ='POST' action='test2.php'>";
            $product_id = $row["id"];
            echo "<input name='product_id' value='$product_id' hidden>";
            echo "<button type='submit' class='custom-button'>view</button>";
            echo "</form>";
            echo "</div>";
         } ?>
    </div>
</body>

</html>

