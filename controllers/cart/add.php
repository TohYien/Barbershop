<?php 
session_start();
$id = $_POST['product_id'];
$quantity = 1;

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