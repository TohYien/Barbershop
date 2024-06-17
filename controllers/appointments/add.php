<?php

session_start();
// require_once connection file

require_once '../connection.php';

// $id = get the customer id from the session
// $product_id = get the product id from the form
// serviceId = get the service id from the form
// $appointment_time = get the appointment time from the form

$id = $_SESSION['customers_info']['customer_id'];
$product_id = $_POST['product_id'];
$serviceId = $_POST['service_id'];
$appointment_time = $_POST['appointment_time'];
$barber_id = $_POST['barber_id'];


// INSERT INTO THE APPOINTMENTS TABLE

$sql = "INSERT INTO appointments (customer_id, product_id, service_id, barber_id, appointment_time) VALUES ($id, $product_id, $serviceId, $barber_id, '$appointment_time')";

if (mysqli_query($cn, $sql)) {
    echo "Appointment added successfully";
    echo "<br>";
    echo "<a href='../../views/pages/appointments.php' class='btn btn-primary'>View Appointments</a>";
} else {
    echo "Error: ". $sql. "<br>". mysqli_error($cn);
}


// close the database connection
mysqli_close($cn);
?>


