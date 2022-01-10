<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../../login.php");
    exit;
}

require '../../config/koneksi.php';
require '../../config/function.php';

$id = $_GET["id"];

if( deleteProduct($id) > 0 ) {
    echo "
            <script>
                alert('Produk berhasil dihapus!');
                document.location.href = 'product.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Produk gagal dihapus!');
            document.location.href = 'product.php';
        </script>
        "; 
}

?>