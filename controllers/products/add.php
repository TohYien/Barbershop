<?php
require_once '../connection.php';
session_start();


$product_name = $_POST['product_name'];
$price = $_POST['price'];

//IMAGE HANDLING
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_type = strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
$img_path = "/public/".time()."_".$img_name;

$extensions = ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp','avif'];
$is_img = false;
// $has_details = false;

if(in_array($img_type, $extensions)) {
    $is_img = true;
} else {
    echo "Please upload an image";
}

if($is_img && $img_size > 0) {
    $query = "INSERT INTO products (product_name, price, image) VALUES ('$product_name', '$price', '$img_path');";

    move_uploaded_file($img_tmpname, "../..".$img_path);
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header("Location: $_SERVER[HTTP_REFERER]");
}