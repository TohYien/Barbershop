<?php 
session_start();
$id = $_POST['id'];
$quantity = intval($_POST['quantity']);

if($quantity < 1) {
    echo "Please input atleast 1";
} else {
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'][$id] = $quantity;
    } else {
        $_SESSION['cart'][$id] += $quantity;
    }
    header("Location: /");
}

// $_SESSION['cart'] = [
//     "1" => 23
//     "2" => 5
// ]