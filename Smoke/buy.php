<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'connect.php';

$user_email = $_SESSION['email'];
$product_id = $_GET['id'];

// Check if the game was already purchased 
$check = mysqli_query($connection, "SELECT * FROM purchases WHERE email='$user_email' AND product_id=$product_id");
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('You already own this game!'); window.location='index.php';</script>";
    exit;
}

// Insert purchase
$query = mysqli_query($connection, "INSERT INTO purchases (email, product_id) VALUES ('$user_email', $product_id)");

if ($query) {
    echo "<script>alert('Purchase successful!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Purchase failed.'); window.location='index.php';</script>";
}
?>
