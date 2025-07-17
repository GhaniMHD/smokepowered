<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    </head>
    <body class="bg-dark text-white">
        <div class="container mt-5 p-3">
            <h1>Login</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                </div>
                <button type="submit" name="submit"  class="btn btn-success w-100">Login</button>
                <div class="text-center mt-2">
                    <a href="register.php" class="text-light">Don't have an account?</a>
                </div>
                
            </form>

            <?php
                // Credential check
                if(isset($_POST['submit'])) {
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];

                    include 'connect.php';
                    $userLog = $connection -> query("SELECT * FROM user WHERE email='$email'");

                    if($userLog -> num_rows === 1) {
                        $user = $userLog -> fetch_assoc();
                        $pass_hash = $user['password'];

                        if(password_verify($pass, $pass_hash)) {
                           session_start();
                           $_SESSION['login'] = TRUE;
                           $_SESSION['email'] = $user['email'];
                           $_SESSION['nama'] = $user['nama'];
                           $_SESSION['level'] = $user['level'];
                           header("Location: index.php");
                           exit;
                        }
                        else {
                            echo "Incorrect password!";
                        }
                    }
                    else {
                        echo "Email is not registered";
                    }
                }
            ?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>