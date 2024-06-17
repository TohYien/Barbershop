<?php
require_once '../connection.php';
session_start();

$service_name = $_POST['service_name'];
$duration = $_POST['duration'];
$price = $_POST['price'];

//IMAGE HANDLING
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name']; 
$img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION)); //JPG -> jpg
$img_path = "/public/".time()."-".$img_name; //32168731276310-file.jpg

$extensions = ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'];
$is_img = false;
// $has_details = false;

if(in_array($img_type, $extensions)) {
    $is_img = true;
} else {
    echo "Please upload an image";
}

if($is_img && $img_size > 0) {
    $query = "INSERT INTO services (service_name, price, duration, image) VALUES ('$service_name', '$price', '$duration', '$img_path');";
    
    move_uploaded_file($img_tmpname, "../..".$img_path);
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header("Location: $_SERVER[HTTP_REFERER]");
} else {
    echo "Error uploading image";
}