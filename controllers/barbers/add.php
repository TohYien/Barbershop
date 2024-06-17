<?php
require_once '../connection.php';
session_start();

$barber_name = $_POST['barber_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$experience = $_POST['experience'];

//IMAGE HANDLING
$img_name = $_FILES['image']['name'];
$img_size = $_FILES['image']['size'];
$img_tmpname = $_FILES['image']['tmp_name'];
$img_type = strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
$img_path = "/public/".time()."_".$img_name;

$extensions = ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'];
$is_img = false;
// $has_details = false;

if(in_array($img_type, $extensions)) {
    $is_img = true;
} else {
    echo "Please upload an image";
}

if($is_img && $img_size > 0) {
    $query = "INSERT INTO barbers (name, phone, email, experience, image) VALUES ('$barber_name', '$phone', '$email', '$experience', '$img_path');";

    move_uploaded_file($img_tmpname, "../..".$img_path);
    mysqli_query($cn, $query);
    mysqli_close($cn);
    header("Location: $_SERVER[HTTP_REFERER]");
}