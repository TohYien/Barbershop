<?php

require_once '../connection.php';
session_start();



if(isset($_SESSION) && !$_SESSION['customers_info']['isAdmin']) {
    echo "You cannot do this action";
}

$id = $_POST['id'];
$barber_name = $_POST['barber_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$experience = $_POST['experience'];

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
            $query = "UPDATE barbers SET image = '$img_path' WHERE barber_id = $id";
            move_uploaded_file($img_tmpname, "../../".$img_path);
            mysqli_query($cn, $query);
        }
}

$details_query = "UPDATE barbers SET name = '$barber_name', phone = $phone, email='$email', experience='$experience' WHERE barber_id = $id;";

mysqli_query($cn, $details_query);
mysqli_close($cn);
header("Location: $_SERVER[HTTP_REFERER]");
// $_SERVER[HTTP_REFERER] - the page where the action is called.