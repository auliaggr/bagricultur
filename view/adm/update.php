<?php
session_start();

include '../../config/function.php';
include '../../config/koneksi.php';
include 'akses.php';

$id = $_GET["id"];
$dataUser = showData("SELECT * FROM user WHERE id = $id")[0];

if( isset($_POST["update"]) ) {
    if( updateData($_POST) > 0 ) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php';
        </script>
        "; 
    }
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
    <link rel="stylesheet" href="../../src/css/login.css">
    <title>BAGRICULTUR</title>
    <link rel="icon" type="img/svg" href="../../src/img/logo.svg">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="d-flex col-lg-12 col-md-6 col-sm-12 left">
                <div class="content mt-lg-4 mt-md-5 mt-sm-3">
                    <a href="index.php">
                        <img class="logo mb-3 mt-4" src="../../src/img/logo.svg" alt="logo bagricultur">
                    </a>
                    <form action="" method="POST"> 
                        <h3 class="text-center judul">UPDATE DATA USER</h3>
                        <div class="mb-3 mt-4">
                            <input type="hidden" name="id" id="id" value="<?= $dataUser["id"]; ?>" class="form-control form-control-sm" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" id="username" value="<?= $dataUser["username"]; ?>" class="form-control form-control-sm" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="email" value="<?= $dataUser["email"]; ?>" class="form-control form-control-sm" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="created_at" id="created_at" value="<?= $dataUser["created_at"]; ?>" readonly class="form-control form-control-sm">
                        </div>
                        <button type="submit" name="update" id="update" class="mb-3 center-block">UPDATE</button>
                    </form>
                    <div class="text-center">
                        <footer>
                            <p class="text-center mt-0">&copy; 2021 . Aulia Anggraeni</p>
                        </footer>
                    </div>
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