Ini hanya ujia coba kolaborasi

<?php
// panggil file koneksi
require'koneksi/koneksi.php';

//ambil data id_siswa yang dikirimkan melalui URL menggunakan $_GET

$id_siswa = $_GET["id_siswa"];

//hapus gambar yang ada di folder gambar
$queryShow = "SELECT * FROM siswa WHERE id_siswa='$id_siswa'";
$sqlShow = mysqli_query($koneksi, $queryShow);

$result = mysqli_fetch_assoc($sqlShow);

// var_dump($result);

unlink("gambar/".$result["gambar"]);

// die();

//query hapus data

$hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa='$id_siswa'");

if($hapus) {
    echo"<script>
    alert('Data Berhasil Dihapus');
    document.location.href='siswa.php';
    </script>";
}else {
    echo"<script>
    alert('Data Gagal Dihapus');
    document.location.href='siswa.php';
    </script>";
}


?>