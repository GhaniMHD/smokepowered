<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'connect.php';
$user_email = $_SESSION['email'];

// Get the game
$query = "
    SELECT p.*
    FROM products p
    INNER JOIN purchases b ON p.id = b.product_id
    WHERE b.user_email = '$user_email'
";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Library - Smoke</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg bg-dark-subtle" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Smoke</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Store</a></li>
                <li class="nav-item"><a class="nav-link active" href="library.php">Library</a></li>
                                <li class="nav-item"><a class="nav-link" href="upload.php">Upload</a></li>
            </ul>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>My Game Library</h2>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col d-flex">
                <div class="card bg-secondary text-white w-100 h-100">
                    <img src="<?= $row['image'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $row['title'] ?></h5>
                        <p class="card-text">Rp<?= number_format($row['price']) ?></p>
                        <a href="<?= $row['image'] ?>" download class="btn btn-primary mt-auto">Download</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
