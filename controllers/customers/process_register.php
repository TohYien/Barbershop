<?php 
require_once '../connection.php';
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

$errors = 0;

if(strlen($username) < 8) {
    $errors++;
    echo "<h4>Username must be atleast 8 characters</h4>";
}

if(strlen($password) < 8 || strlen($password2) < 8) {
    $errors++;
    echo "<h4>Password must be atleast 8 characters</h4>";
}

if($password != $password2) {
    $errors++;
    echo "<h4>Password and Confirm Password should match</h4>";
}

if($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo("$email is not a valid email address");
    }

    $query = "SELECT email FROM customers WHERE email = '$email'";
    $result = mysqli_fetch_assoc(mysqli_query($cn, $query));

    if($result) {
        echo "email is already taken";
        $errors++;
        mysqli_close($cn);
    }

}

if($username) {
    $query = "SELECT username FROM customers WHERE username = '$username'";
    
    $result2 = mysqli_fetch_assoc(mysqli_query($cn, $query));

    if($result2) {
        echo "Username is already taken";
        $errors++;
        mysqli_close($cn);
    }
}

if($errors > 0) {
    echo "<a href='/views/pages/register.php'>Go back to register</a>";
}

if($errors === 0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO customers (username, password, email, phone, address) VALUES ('$username', '$password', '$email', '$phone','$address');";
    mysqli_query($cn, $query);
    mysqli_close($cn);
    
    session_start();
    $_SESSION['class'] = "success";
    $_SESSION['message'] = "Register Successfully";
    header("Location: /");
}