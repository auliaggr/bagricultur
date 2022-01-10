<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: ../../login.php");
    exit;
}

require '../../config/koneksi.php';
require '../../config/function.php';

$id = $_GET["id"];

if( deleteData($id) > 0 ) {
    echo "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'index.php';
        </script>
        "; 
}

?>