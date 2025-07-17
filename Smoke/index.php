<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Smoke</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg bg-dark-subtle" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Smoke</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= !isset($_GET['page']) ? 'active' : '' ?>" href="index.php">Store</a>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="library.php">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="upload.php">Upload</a>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </form>
        </div>
    </div>
</nav>


<div class="container mt-5">
    <h2>Welcome, <?= $_SESSION['nama']; ?>!</h2>

    <hr class="border-light">

<?php
include 'connect.php';
$result = mysqli_query($connection, "SELECT * FROM products");
?>

<div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="col">
        <div class="card h-100 bg-secondary text-white">
            <img src="<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['title'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $row['title'] ?></h5>
                <p class="card-text">Rp<?= number_format($row['price']) ?></p>
                <a href="buy.php?id=<?= $row['id'] ?>" class="btn btn-light w-100">Buy</a>

            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>

<?php
$purchased_id = [];
$user_email = $_SESSION['email'];
$check = mysqli_query($connection, "SELECT product_id FROM purchases WHERE user_email='$user_email'");
while ($row_p = mysqli_fetch_assoc($check)) {
    $purchased_id[] = $row_p['product_id'];
}
?>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="col">
        <div class="card h-100 bg-secondary text-white">
            <img src="<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['title'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $row['title'] ?></h5>
                <p class="card-text">Rp<?= number_format($row['price']) ?></p>

                <?php if (in_array($row['id'], $purchased_ids)): ?>
                    <a href="<?= $row['image'] ?>" download class="btn btn-success w-100">Download</a>
                <?php else: ?>
                    <a href="buy.php?id=<?= $row['id'] ?>" class="btn btn-light w-100">Buy</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>


</body>
</html>
