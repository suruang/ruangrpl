<?php
// panggil file koneksi
require'koneksi/koneksi.php';

//ambil data id_siswa yang dikirimkan melalui URL menggunakan $_GET

$id_siswa = $_GET["id_siswa"];

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