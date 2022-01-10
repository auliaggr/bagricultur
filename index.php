<?php 
    session_start();
    require 'config/koneksi.php';
    require 'config/function.php';
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
    <title>BAGRICULTUR</title>
    <link rel="icon" type="image/svg" href="src/img/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
    <!-- ========================================== NAV ======================================== -->
    <?php include './view/layouts/navbar.php' ?>

    <!-- ========================================== MAIN ======================================== -->
    <main>
        <!-- ====================================== SECTION 1 ===================================== -->
        <div id="home" class="section hero">
            <div class="intro">
                <h1 data-aos="fade-up" data-aos-delay=""><span class="typed-words"></span></h1>
                <a href="#category" class="btn btn-outline-light btn-sm mx-1" data-aos="fade-up" data-aos-delay="100">Explore More</a>
            </div>
            <div class="slides overlay">
                <img src="src/img/cover1.png" class="active" alt="COVER">
                <img src="src/img/cover2.png" alt="COVER">
                <img src="src/img/cover3.png" alt="COVER">
                <img src="src/img/cover4.png" alt="COVER">
                <img src="src/img/cover5.png" alt="COVER">
            </div>
        </div>

        <!-- ====================================== SECTION 2 ===================================== -->
        <div id="category" class="section py-5">
            <div class="container">
                <div class="row">
                    <h2 class="text-lg-start text-md-center text-sm-center">Category</h2>
                </div>
                <div class="row row-cols-lg-6 row-cols-md-6 row-cols-sm-6 g-2">
                    <?php 
                        $i = 1;
                        foreach( $resultKategori as $row ) : 
                    ?>
                    <div class="col">
                        <div class="text-center mt-5 mb-5 p-2">
                            <a href="#" class=""><?= $row["icon_kategori"]; ?></a>
                        </div>
                        <div class="text-center">
                            <p><?= $row["nama_kategori"]; ?></p>
                        </div>
                    </div>
                    <?php 
                        $i++;
                        endforeach; 
                    ?>
                </div>
            </div>
        </div>

        <!-- ====================================== SECTION 3 ===================================== -->
        <div id="" class="section py-5" style="background: #B9CAB9;">
            <div class="container">
                <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                        <img src="src/img/logo.svg" alt="">
                    </div>
                    <div class="col">
                        <h2>Fresh Agricultur Fruits</h2>
                        <h2>In Our Store</h2>
                        <small>
                            Lorem ipsum dolor sit amet, <br>
                            consectetur adipiscing elit, sed
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- ====================================== SECTION 4 ===================================== -->
        <div id="product" class="section my-5 py-5">
            <div class="container">
                <div class="row-cols-lg-3 d-flex justify-content-between align-items-center">
                    <h2 class="py-3">Popular This Month</h2>
                    <div>
                        <form action="" method="GET" id="kategori" class="py-3">
                            <select name="kategori" onchange="document.getElementById('kategori').submit();" class="form-select" aria-label="Default select example">
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
                                    <h6 class="card-title " style="margin-top: -15px;"><?= $row["judul_produk"]; ?></h6>
                                    <small class="card-text fw-light" style="margin-top: -23px; color: #B9CAB9;"><?= $row["nama_kategori"]; ?></small>
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
                        if ($i == 9) {
                            break;
                        }
                        endforeach; 
                    ?>
                </div>
            </div>
        </div>

        <!-- ====================================== SECTION 5 ===================================== -->
        <div id="discount" class="section my-5 py-5">
            <div class="container rounded rounded-3 py-5" style="background: #B9CAB9;">
                <div class="row-cols-lg-1 row-cols-md-1 row-cols-sm-1 d-flex justify-content-center align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="py-3 mx-3 text-center">
                            <h2>Get Voucher</h2>
                            <h2>Discount Up To 70%</h2>
                            <small>Updated, latest and competitive prices</small><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ========================================== FOOTER ======================================== -->
    <?php include './view/layouts/footer.php' ?>

</body>
</html>