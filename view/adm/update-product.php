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

    $resultCategory = showData("SELECT kategori.nama_kategori, kategori.icon_kategori
    FROM kategori JOIN produk ON produk.id = kategori.id");

    $id = $_GET["id"];
    $dataProduct = showData("SELECT * FROM produk WHERE id = $id")[0];

    if( isset($_POST["update-produk"]) ) {

        // cek data berhasil ditambahkan
        if( updateProduct($_POST) > 0 ) {
            echo "
                <script>
                    alert('Produk berhasil diupdate!');
                    document.location.href = 'product.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('Produk gagal diupdate!');
                document.location.href = 'product.php';
            </script>
            "; 
        }
    }

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
                            <h2 class="text-center">UPDATE PRODUCT</h2>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3 mt-4">
                                    <input type="hidden" name="id" id="id" value="<?= $dataProduct["id"]; ?>" class="form-control form-control-sm" aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-floating mb-3 mt-4">
                                    <select class="form-select" id="floatingSelect" value="<?= $dataProduct["nama_kategori"]; ?>" aria-label="Floating label select example" name="kategori_id">
                                        <?php foreach($resultKategori as $kategori)  : ?>
                                            <?php if(isset($_GET['kategori'])) : ?>
                                                <option <?= $_GET['kategori'] == $kategori['id'] ? 'selected' : '' ?> value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>                                
                                            <?php else : ?>
                                                <option value="<?= $kategori['id'] ?>"><?= $kategori["nama_kategori"]; ?></option>                                
                                            <?php endif?>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelect">Category</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?= $dataProduct["judul_produk"]; ?>" name="judul_produk" id="judul_produk" placeholder="judul_produk" required>
                                    <label for="judul_produk">Product Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?= $dataProduct["stok"]; ?>" name="stok" id="stok" placeholder="stok" required>
                                    <label for="stok">Stock</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?= $dataProduct["harga"]; ?>" name="harga" id="harga" placeholder="harga" required>
                                    <label for="harga">Price</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?= $dataProduct["deskripsi"]; ?>" name="deskripsi" id="deskripsi" placeholder="deskripsi" required>
                                    <label for="deskripsi">Description</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <div class="mb-3">
                                        <input class="form-control form-control-lg fs-6" type="file" value="<?= $dataProduct["gambar"]; ?>" name="gambar" id="gambar">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-dark" type="submit" name="update-produk">UPDATE PRODUCT</button>
                                </div>
                            </form>
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
