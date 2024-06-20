<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("location:../login_logout/login.php");
}
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
$sql = "SELECT * from user_admin";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Show Info Admin</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
            <h1>Thông tin user_admin</h1>
            <a href="../../customer/home/home.php">Home</a>
            <br>
            <a href="../../admin/product/index.php">Insert ProDuct</a>
            <br>
            <a href="./create_admin.php">Create Account admin</a>
        </header>
        <main>
            <table>
                <thead>
                    <th>id</th>
                    <th>email</th>
                    <th>user_admin</th>
                    <th>pass_word</th>
                    <th>status</th>
                    <th>created_time</th>
                    <th>Update</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php
                         while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['user_name']."</td>";
                            echo "<td>".$row['pass_word']."</td>";
                            if($row['status'] == 1){
                                $status = "Online";
                            }
                            else{
                                $status = "Offline";
                            }
                            echo "<td>".$status."</td>";
                            // echo "<td>".$row['created_time']."</td>";
                            echo "<td>".date('d/m/Y H:i',$row['created_time'])."</td>";
                            
                            echo "<td>";
                            echo "<a href='./showUpdate.php?id=".$row['id'];
                            echo "'>";
                            echo "<button type='button' class='btn btn-outline-primary btn-lg btn-sm'>"."Chỉnh sửa"."</button>";
                            echo "</a>";
                            echo "</td>";


                            echo "<td>";
                            echo "<a href='./processToDeleteTableToan9.php?id=".$row['id'];
                            echo "'>";
                            echo "<button onclick='deleteData()' type='button' class='btn btn-danger' type='submit'>  "."Xóa"."</button>";
                            echo "</a>";
                            echo "</td>";


                            echo "</tr>";
                        }

                    ?>
                </tbody>

            </table>

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script>
            function deleteData(){
            confirm("Bạn Có Chắc Muốn Xóa Không?");
         }
        </script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
