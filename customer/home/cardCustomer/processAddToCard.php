<?php

if(isset($_POST['old_url'])){
    $url = 'location:';
    $url = $url .$_POST['old_url'];
}
else{
    $url = 'location:./showCart.php';
}

session_start();
if(isset($_GET['status'])){
    $cart_id = intval($_GET['id']);
    if($_GET['status'] == 'plus'){
        // plus
        
        // intval($string)
        // echo $cart_id; exit;
        $_SESSION['cart'][$cart_id]++;
        // echo $_SESSION['cart'][$cart_id]; exit;
        header('location:./showCart.php');
        exit;
    }
    else{
        // minus
        if($_SESSION['cart'][$cart_id] === 1){
            unset($_SESSION['cart'][$cart_id]);
            header('location:./showCart.php');
            exit;
        }
        else{
            $_SESSION['cart'][$cart_id]--;
            header('location:./showCart.php');
            exit;
        }
    }
}










$id = $_POST['product_id_cart'];
if(!isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id] = 1;
    header($url);
    exit;
}
if(!empty($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]++;
    header($url); 
    exit;   
}
// print_r($_SESSION['cart']);
?>