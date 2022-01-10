<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$db = "bagricultur";

$koneksi = mysqli_connect($hostname, $username, $password, $db);

// Cek terhubung atau tidak databasenya
// if ( !$koneksi ) {
//     echo "Gagal Terhubung Ke Database";
// } else {
//     echo "Berhasil Terhubung Ke Database";
// }

?>