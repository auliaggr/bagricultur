<?php
    session_start();
    include 'akses.php';

    include '../../config/koneksi.php';
    include '../../config/function.php';
    
    if(isset($_GET['kategori'])) {
        $kategori = $_GET['kategori'];
        $resultProduk = showData("SELECT produk.id, produk.judul_produk, produk.gambar, produk.harga, 
        produk.stok, produk.deskripsi, produk.create_at, kategori.nama_kategori 
        FROM produk JOIN kategori ON kategori.id = produk.kategori_id where kategori.id = $kategori ");
    } else {
        $resultProduk = showData("SELECT produk.id, produk.judul_produk, produk.gambar, produk.harga, 
        produk.stok, produk.deskripsi, produk.create_at, kategori.nama_kategori 
        FROM produk JOIN kategori ON kategori.id = produk.kategori_id ");
    }
    $resultKategori = showData("SELECT * FROM kategori");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="Description" content="Ilmu Pertanian, Bisnis Pertanian">
    <meta name="Keyword" content="Bagricultur">
    <meta name="author" content="Aulia Anggraeni">
    <title>BAGRICULTUR - ADMIN PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../../src/img/logo.svg"/>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link href="../../src/css/adm.css" rel="stylesheet"/>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../../index.php">
                    <img src="../../src/img/logo.svg" alt="logo" width="30" height="24" class="d-inline-block align-text-top">
                    BAGRICULTUR
                    </a>
                </div>
            </nav>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">User</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="category.php">Category</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active" href="product.php">Product</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="add-product.php">Add Product</a>
            </div>
        </div>
        <!-- content wrapper-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn" id="sidebarToggle">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="navbar-nav">
                    <li class="nav-item">
                            <a class="btn btn-outline-dark" aria-current="page" href="../../logout.php">SIGN OUT</a>
                        </li>
                    </ul>
                    <div class="collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="col-lg-12 col-md-6 col-sm-6 px-0 flex-grow-1">
                <div class="container py-3">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center">PRODUCT</h2>
                            <form class="d-flex my-2" method="POST">
                                <a href="add-product.php" class="btn btn-dark btn-sm d-flex justify-content-center align-items-center" style="margin-right: 0.5rem;">
                                    <span class="iconify" data-icon="ph:plus" data-width="20" data-height="20"></span>
                                </a>
                                <input class="form-control me-2" type="search" name="keyword" autofocus placeholder="Masukan keyword pencarian.." autocomplete="off" aria-label="Search">
                                <button class="btn btn-outline-success" name="search" type="search">Search</button>
                            </form>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width:40px;">NO</th>
                                        <th scope="col" class="text-center">ACTION</th>
                                        <th scope="col" class="text-center">CATEGORY</th>
                                        <th scope="col" class="text-center">NAME</th>
                                        <th scope="col" class="text-center">PICTURE</th>
                                        <th scope="col" class="text-center">STOCK</th>
                                        <th scope="col" class="text-center">PRICE</th>
                                        <th scope="col" class="text-center">DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach( $resultProduk as $row ) : ?>
                                    <tr>
                                        <td scope="row" class="text-center"><?= $i; ?></td>
                                        <td class="text-center">
                                            <!-- <a href="update-product.php?id=<?= $row['id'] ?>" class="btn btn-dark btn-sm">
                                                <span class="iconify" data-icon="ph:note-pencil" data-width="20" data-height="20"></span>
                                            </a> -->
                                            <a href="delete-product.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda yakin?')" class="btn btn-danger btn-sm">
                                                <span class="iconify" data-icon="ph:trash" data-width="20" data-height="20"></span>
                                            </a>
                                        </td>
                                        <td class="text-wrap text-center"><?= $row["nama_kategori"]; ?></td>
                                        <td class="text-wrap text-center"><?= $row["judul_produk"]; ?></td>
                                        <td class="text-wrap text-center">
                                            <img src="../../src/img/<?= $row["gambar"]; ?>" alt="" width="100px">
                                            </td>
                                        <td class="text-wrap text-center"><?= $row["stok"]; ?></td>
                                        <td class="text-wrap text-center"><?= $row["harga"]; ?></td>
                                        <td class="text-wrap text-center" style="width: 300px"><?= $row["deskripsi"]; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <footer class="footer py-0">
                    <div class="container">
                        <span class="text-muted">
                            <p class="text-center">&copy; 2021 . Aulia Anggraeni</p>
                        </span>
                    </div>
                </footer>
            </main>
        </div>
    </div>
    

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS--> 
    <script src="../../src/js/scripts.js"></script>
</body>
</html>
