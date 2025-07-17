<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'connect.php';

$user_email = $_SESSION['email'];
$product_id = $_GET['id'];

// Get product
$product_q = mysqli_query($connection, "SELECT * FROM products WHERE id = $product_id");
$product = mysqli_fetch_assoc($product_q);

if (!$product) {
    die("Product not found.");
}

// Check if this user bought it
$check = mysqli_query($connection, "SELECT * FROM purchases WHERE user_email='$user_email' AND product_id=$product_id");
if (mysqli_num_rows($check) === 0) {
    die("You didn't buy this.");
}

// Mark as downloaded
mysqli_query($connection, "
    UPDATE purchases 
    SET downloaded = 1, download_time = NOW() 
    WHERE user_email='$user_email' AND product_id=$product_id
");

// Serve the file
$file = $product['image'];
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File not found.";
}
?>
