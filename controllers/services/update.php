<?php

require_once '../connection.php';
session_start();

if(isset($_SESSION) && !$_SESSION['customers_info']['isAdmin']) {
    echo "You cannot do this action";
}

//UPDATE sercive DETAILS

$service_id = $_POST['service_id'];
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


if($_FILES) { //check if the admin is updating the image
    if(in_array($img_type, $extensions)) {
        $is_img = true;
    } else {
        echo "Please upload an image";
    }

    if($is_img && $img_size > 0) {
        //we are only updating the image column on the database.
        $query = "UPDATE services SET image = '$img_path' WHERE service_id = $service_id";
        move_uploaded_file($img_tmpname, "../../".$img_path);
        mysqli_query($cn, $query);
    }
}

$details_query = "UPDATE services SET service_name = '$service_name',  duration = '$duration', price = '$price' WHERE service_id = $service_id;";

mysqli_query($cn, $details_query);
mysqli_close($cn);
header("Location: $_SERVER[HTTP_REFERER]");
// $_SERVER[HTTP_REFERER] - the page where the action is called.    