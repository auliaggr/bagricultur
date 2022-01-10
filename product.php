<?php 
    session_start();
    require 'config/koneksi.php';
    require 'config/function.php';


    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $kategori = $_GET['kategori'];
        if($kategori == 0) {
            $resultProduk = showData("SELECT produk.id, produk.judul_produk, produk.gambar, produk.harga, produk.stok, produk.deskripsi, produk.create_at, kategori.nama_kategori FROM produk JOIN kategori ON kategori.id = produk.kategori_id where produk.judul_produk LIKE '%$search%'");
        } else {
            $resultProduk = showData("SELECT produk.id, produk.judul_produk, produk.gambar, produk.harga, produk.stok, produk.deskripsi, produk.create_at, kategori.nama_kategori FROM produk JOIN kategori ON kategori.id = produk.kategori_id where kategori.id = $kategori AND produk.judul_produk LIKE '%$search%'");
        }
    } else {
        $resultProduk = showData("SELECT produk.id, produk.judul_produk, produk.gambar, produk.harga, produk.stok, produk.deskripsi, produk.create_at, kategori.nama_kategori FROM produk JOIN kategori ON kategori.id = produk.kategori_id ");
    }
    
    $resultKategori = showData("SELECT * FROM kategori");

    if( isset($_POST["cart"]) ) {
        if( addToCart($_POST) > 0 ) {
            echo "
                <script>
                    alert('Produk berhasil dimasukkan ke keranjang!');
                    document.location.href = 'cart.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('Produk gagal dimasukkan ke keranjang!');
                document.location.href = 'product.php';
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
    <title>BAGRICULTUR - PRODUCT</title>
    <link rel="icon" type="image/svg" href="src/img/logo.svg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
    <?php include 'view/layouts/navbar.php'; ?>

    <div class="section">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col d-flex justify-content-between align-items-center">
                    <form action="" method="GET" id="kategori">
                        <?php if(isset($_GET['search'])) :?>
                            <input type="hidden" name="search" value="<?= $_GET['search'] ?>">
                        <?php else :?>
                            <input type="hidden" name="search" value="">
                        <?php endif;?>
                        <select class="form-select" name="kategori" onchange="document.getElementById('kategori').submit();" aria-label="Default select example">
                            <?php foreach($resultKategori as $kategori)  : ?>
                                <?php if(isset($_GET['kategori'])) : ?>
                                    <option <?= $_GET['kategori'] == $kategori['id'] ? 'selected' : '' ?> value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>                                
                                <?php else : ?>
                                    <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>                                
                                <?php endif?>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <div class="col">
                    <form class="d-flex my-3" method="GET" id="search">
                    <?php if(isset($_GET['kategori'])) :?>
                        <input type="hidden" name="kategori" value="<?= $_GET['kategori'] ?>">
                    <?php else :?>
                        <input type="hidden" name="kategori" value="0">
                    <?php endif;?>
                        <input class="form-control me-2" type="search" name="search" autofocus placeholder="Masukan keyword pencarian.." autocomplete="off" aria-label="Search">
                        <button class="btn btn-outline-success" onchange="document.getElementById('search').submit();">Search</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php 
                    $i = 1;
                    foreach( $resultProduk as $row ) : 
                ?>
                <div class="d-flex col-lg-3 col-md-4 col-sm-6 my-3 justify-content-center align-items-center">
                    <div class="card m-0" style="width: 18rem;">
                        <img src="src/img/<?= $row["gambar"]; ?>" class="card-img-top" alt="..." height="190px" style="padding: 15px;">
                        <div class="card-body px-3">
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <h6 class="card-title" style="margin-top: -15px;"><?= $row["judul_produk"]; ?></h6>
                                <small class="card-text fw-light" style="margin-top: -15px; color: #B9CAB9;"><?= $row["nama_kategori"]; ?></small>
                            </div>
                            <small class="card-text"><?= $row["deskripsi"]; ?></small>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <small class="card-text">Rp <?= number_format($row["harga"]); ?></small>
                                <form method="POST">
                                    <input type="hidden" name="produk_id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="cart" class="btn d-flex justify-content-center align-items-center">
                                        <span class="iconify" data-icon="ph:shopping-cart" style="color: #507a4f;" data-width="20" data-height="20"></span>
                                    </button>
                                </form>
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
    </div>

    <?php include 'view/layouts/footer.php'; ?>

</body>
</html>