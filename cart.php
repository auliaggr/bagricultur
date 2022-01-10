<?php

    session_start();
    include 'config/koneksi.php';
    include 'config/function.php';
    include 'config/akses.php';

    $id = $_SESSION["user"]["id"];
    $resultCart = showData("SELECT produk.id, produk.judul_produk, produk.gambar, produk.harga, produk.stok, 
    produk.deskripsi, produk.create_at, user.username, user.id as user_id, user.email
    FROM keranjang 
    JOIN user ON user.id = keranjang.user_id
    JOIN produk ON produk.id = keranjang.produk_id
    WHERE user.id = $id");

if( isset($_POST["payment"]) ) {
    if( beliProduk($_POST) > 0 ) {
        echo "
            <script>
                alert('Produk berhasil dibeli!');
                document.location.href = 'cart.php';
            </script>
        ";
        if( deleteCart($_POST) > 0 ) {
            echo "
            <script>
                document.location.href = 'cart.php';
            </script>
        ";
        }
    } else {
        echo "
        <script>
            alert('Produk gagal dibeli!');
            document.location.href = 'product.php';
        </script>
        "; 
    }
}


?>

<!DOCTYPE html>
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
    <title>BAGRICULTUR</title>
    <link rel="icon" type="image/svg" href="src/img/logo.svg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="src/css/style.css">
    <style>
        .btn-hover:hover {
            background: #282117;
        }
    </style>
</head>
<body style="background-color: #f1f1f1;">
    <?php include 'view/layouts/navbar.php'; ?>

    <main>
        <div class="section py-5">
            <div class="container">
                    <?php 
                        $i = 1;
                        foreach( $resultCart as $row ) : 
                    ?>
                    <div class="overflow-hidden row-cols-lg-4 row-cols-md-4 row-cols-sm-4 py-3 mb-3 rounded d-flex justify-content-between align-items-center" style="background-color: #ffffff;">
                        <div class="col-lg-3 col-md-3 col-sm-3" style="width: 3.7rem;">
                            <div class="mx-3">
                                <img class="rounded" src="src/img/<?= $row["gambar"]; ?>" alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mx-sm-0">
                                <small class="fw-normal"><?= $row["judul_produk"]; ?></small><br>
                                <small class="fw-light">Stock : <?= $row["stok"]; ?></small><br>
                                <small class="fw-light">Rp. <?= number_format($row["harga"]); ?></small>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <a href="">
                                <span class="iconify text-black-50" data-icon="ph:trash" data-width="20" data-height="20" style="color: #B9CAB9;"></span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 ">
                            <div class="mx-lg-3 mx-md-3 mx-sm-3 d-flex justify-content-end align-items-center">
                                <button type="button" name="checkout" class="btn text-black-50" style="background: #B9CAB9;" data-bs-toggle="modal" data-bs-target="#exampleModal-<?= $row['id'] ?>">
                                    CHECKOUT
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-light" id="exampleModalLabel">ORDER SUMMARY</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row-cols-lg-3 row-cols-md-3 row-cols-sm-3 d-flex justify-content-center align-items-center">
                                            <div class="col-lg-4 col-md-4 col-sm-4 text-start">
                                                <small>Subtotal Product</small><br>
                                                <small>Shipping Cost</small><br>
                                                <small>Total Amount</small>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                <small> : </small><br>
                                                <small> : </small><br>
                                                <small> : </small>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                                <small>Rp. <?= number_format($row["harga"]); ?></small><br>
                                                <small>Rp. 10000</small><br>
                                                <small>Rp. <?= number_format($row['harga'] + 10000) ?></small><br>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-danger fw-lighter" data-bs-dismiss="modal">Close</button>
                                            <form action="" method="POST">
                                                <input type="hidden" name="produk_id" value="<?= $row["id"]; ?>">
                                                <button type="submit" class="btn text-white fw-lighter" name="payment" style="background: #282117;">Payment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $i++;
                        endforeach; 
                    ?>
            </div>
        </div>
    </main>

    <?php include 'view/layouts/footer.php'; ?>
</body>
</html>