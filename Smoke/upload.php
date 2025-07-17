<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'connect.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];

    // file upload
    $filename = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];
    $folder = "uploads/" . $filename;

    // Move the file to upload folder
    if (move_uploaded_file($tmpname, $folder)) {
        $query = "INSERT INTO products (title, price, image) VALUES ('$title', '$price', '$folder')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script>alert('Game uploaded successfully!'); window.location='index.php';</script>";
        } else {
           echo "<script>alert('Failed to upload game!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Game - Smoke</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2>Upload Game</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required />
        </div>
        <button type="submit" name="submit" class="btn btn-success w-100">Upload Game</button>
    </form>
    <a href="index.php" class="btn btn-light mt-3">Back to Store</a>
</div>
</body>
</html>
