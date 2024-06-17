<?php
require_once '../connection.php';
session_start();

$total = $_POST['total'];
$customer_id = $_SESSION['customer_info']['id'];

$appointment_query = "INSERT INTO appointments (customer_id, total) 
VALUES ($customer_id, $total);";

if(mysqli_query($cn, $appointment_query)) {
    $last_id = mysqli_insert_id($cn);

    foreach($_SESSION['cart'] as $product_id => $quantity) {
        $product_appointments_query = "INSERT INTO product_appointments (product_id, order_id, quantity) VALUES ($product_id, $last_id, $quantity);";

        mysqli_query($cn, $product_appointments_query);
    }
    mysqli_close($cn);

    //CALL BILLPLZ API

    unset($_SESSION['cart']);
    header("Location: $_SERVER[HTTP_REFERER]");
    
} else {
    echo "Error: " . mysqli_error($cn);
    die();
}

 