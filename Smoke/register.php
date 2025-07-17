<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $check = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered!'); window.location='register.php';</script>";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($connection, "INSERT INTO user (email, password, nama) VALUES ('$email', '$hashed', '$nama')");

        if ($query) {
            echo "<script>alert('Sign up success! Proceed to log-in.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Sign up failed!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Smoke</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h2 class="text-center mb-4">Register - Smoke</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="nama" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>
        <button type="submit" name="submit" class="btn btn-success w-100">Register</button>
        <div class="text-center mt-2">
            <a href="login.php" class="text-light">Already have an account? Just log-in</a>
        </div>
    </form>
</div>
</body>
</html>
