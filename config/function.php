<?php

include 'koneksi.php';

function showData($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function createData($data) {
    global $koneksi;
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);
    $result = mysqli_query($koneksi, "INSERT INTO users VALUES ('', '$username', '$email', '$password', current_timestamp(), current_timestamp())");
    return mysqli_affected_rows($koneksi);
}

function addProduct($data) {
    // ambil data dari tiap elemen dalam form
    global $koneksi;
    $kategori_id = htmlspecialchars($data["kategori_id"]);
    $judul_produk = htmlspecialchars($data["judul_produk"]);
    $stok = htmlspecialchars($data["stok"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO produk
                VALUES
                ('', '$kategori_id' , '$judul_produk', '$gambar', '$stok', '$harga', '$deskripsi', current_timestamp())
            ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function addToCart($data) {
    global $koneksi;
    $user_id = $_SESSION['user']['id'];
    $produk_id = htmlspecialchars($data["produk_id"]);

    $keranjang = showData("SELECT * FROM keranjang where produk_id = '$produk_id' AND user_id = '$user_id' ");

    if($keranjang) {
        return 0;
    } else {
        $insertCart = "INSERT INTO keranjang VALUES ('', '$user_id', '$produk_id') ";
        mysqli_query($koneksi, $insertCart);
        return mysqli_affected_rows($koneksi);
    }
}

function deleteCart($data) {
    global $koneksi;
    $user_id = $_SESSION['user']['id'];
    $produk_id = htmlspecialchars($data["produk_id"]);
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE produk_id = '$produk_id' AND user_id = '$user_id'");
    return mysqli_affected_rows($koneksi);
}

function beliProduk($data) {
    global $koneksi;
    $user_id = $_SESSION['user']['id'];
    $produk_id = htmlspecialchars($data["produk_id"]);

    $insertBeli = "INSERT INTO beli VALUES ('', '$user_id', '$produk_id') ";
    mysqli_query($koneksi, $insertBeli);
    return mysqli_affected_rows($koneksi);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "
            <script>
                alert('Pilih Gambar terlebih dahulu');
            </script>
            ";
        return false;
    }

    // cek gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'svg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "
            <script>
                alert('Yang anda upload bukan gambar!');
            </script>
            ";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 4000000 ) {
        echo "
            <script>
                alert('Ukuran gambar terlalu besar');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap di upload
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../../src/img/' . $namaFileBaru);
    return $namaFileBaru;

}

function deleteData($data) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id = '$data' ");
    return mysqli_affected_rows($koneksi);
}

function deleteProduct($data) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM produk WHERE id = $data");
    return mysqli_affected_rows($koneksi);
}

function updateData($data) {
    global $koneksi;

    $id = $data["id"];
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $created_at = $data["created_at"];

    // query insert data
    $dataUpdate = "UPDATE user SET
                username = '$username',
                email = '$email',
                created_at = '$created_at',
                updated_at = current_timestamp()
            WHERE id = '$id' ";
    mysqli_query($koneksi, $dataUpdate);
    return mysqli_affected_rows($koneksi);
}

function updateProduct($data) {
    global $koneksi;
    $id = $data["id"];
    $kategori_id = htmlspecialchars($data["kategori_id"]);
    $judul_produk = htmlspecialchars($data["judul_produk"]);
    $stok = htmlspecialchars($data["stok"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);    

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query insert data
    $productUpdate = "UPDATE produk SET
                kategori_id = '$kategori_id',
                judul_produk = '$judul_produk',
                stok = '$stok',
                harga = '$harga',
                deskripsi = '$deskripsi',
                gambar = '$gambar',
                updated_at = current_timestamp()
            WHERE id = '$id' ";
    mysqli_query($koneksi, $productUpdate);
    return mysqli_affected_rows($koneksi);
}

function searchDataUser($keyword) {
    $cariData = "SELECT * FROM user
                WHERE
            username LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
        ";
    return ShowData($cariData);
}

function register($data) {
    global $koneksi;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // cek email sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT email FROM user
            WHERE email = '$email'");
    if( mysqli_fetch_assoc($result) ) {
        echo "
            <script>
                alert('email sudah terdaftar!');
            </script>";
        return false;
    }

    // cek konfirmasi password 
    if( $password !== $password2 ) {
        echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan user baru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES('', '2' , '$username' , '$email', '$password', current_timestamp(), current_timestamp())");

    return mysqli_affected_rows($koneksi);
    
}

?>