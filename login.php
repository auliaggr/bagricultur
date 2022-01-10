<?php
session_start();

if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

require 'config/function.php';
require 'config/koneksi.php';

if( isset($_POST["login"]) ) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["login"] = true;
            if( $row['role_id'] == 2 ) {
                $_SESSION['user'] = $row ? $row : null;
                header("Location: index.php");
            } else {
                $_SESSION['admin'] = $row ? $row : null;
                header("Location: view/adm/index.php");
            }
            exit;
        }

    }

    $error = true;

}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="Description" content="Ilmu Pertanian, Bisnis Pertanian">
    <meta name="Keyword" content="Bagricultur">
    <meta name="author" content="Aulia Anggraeni">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/login.css">
    <title>BAGRICULTUR</title>
    <link rel="icon" type="img/svg" href="src/img/logo.svg">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 left">
                <div class="content mt-lg-5 mt-md-5 mt-sm-3">
                    <a href="index.php">
                        <img class="logo mb-3 mt-4" src="src/img/logo.svg" alt="logo bagricultur">
                    </a>
                    <form action="" method="POST"> 
                        <h3 class="text-center judul">SIGN IN</h3>

                        <?php if( isset($error) ) : ?>
                            <p style="color: red; font-style: italic; text-align:center;">Username / password salah</p>
                        <?php endif; ?>

                        <p class="deskripsi mt-3 mb-4 text-center">See your growth and get<br>
                            consulting support!</p>
                        <div class="mb-3 mt-4">
                            <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email"aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input checkbox" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            <div class="float-end">
                                <a href="forgot.php" class="link-page text-decoration-none">Forgot Your Password?</a>
                            </div>
                        </div>
                        <button type="submit" name="login" class=" mb-3 center-block">SIGN IN</button>
                        <div class="text-center">
                            <p>
                                Don't have an account? <a href="register.php" class="link-page text-decoration-none other">Sign Up</a>
                            </p>
                            <footer>
                                <p class="text-center mt-0">&copy; 2021 . Aulia Anggraeni</p>
                            </footer>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 right">
                <div class="content m-5 mx-5 my-5 mt-lg-5">
                    <h3 class="mt-4 mb-3 h3 mt-lg-5 mt-md-5 mt-sm-3">WELCOME TO BAGRICULTUR COMMUNITY</h3>
                    <p class="mb-3">See your growth and get consulting support with Bagricultur who will provide several tutors with certain packages that are already available here!</p>
                    <img src="src/img/illustrasi-bagri.svg" class="illustration mt-3" alt="bagricultur">
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>