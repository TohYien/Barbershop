<?php

require_once '../connection.php';

$id = $_POST['appointment_id'];


$sql = "UPDATE appointments SET isPaid = 1 WHERE appointment_id = $id";

mysqli_query($cn, $sql);
mysqli_close($cn);
header("Location: ../../views/pages/appointments.php");