<?php 
require_once '../connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM customers WHERE username = '$username'";
// $result = mysqli_query($cn, $query)
$customers = mysqli_fetch_assoc(mysqli_query($cn, $query));

if($customers && password_verify($password, $customers['password'])) {
    session_start();
    $_SESSION['customers_info'] = $customers;
    $_SESSION['class'] = 'success';
    $_SESSION['message'] = 'Login Successfully';
    mysqli_close($cn);
    header('Location: /');
} else {
    echo "<h4>Wrong Credentials</h4>";
    echo "<a href='/views/login.php'>Go back to login</a>";
}