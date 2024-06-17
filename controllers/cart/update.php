<?php 
session_start();

$id = $_POST['id'];
$quantity = intval($_POST['quantity']);

// if($quantity < 1) {
//     echo "<h4>Please input atleast 1<h4>";
//     echo "<a href='$_SERVER[HTTP_REFERER]'>Go back</a>";
// } else {
$_SESSION['cart'][$id] = $quantity;
header("Location: $_SERVER[HTTP_REFERER]");