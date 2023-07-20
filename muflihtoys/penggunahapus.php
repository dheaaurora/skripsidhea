<?php include('koneksi.php');
if ($_SESSION['admin']['level'] != "Admin") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
} ?>
<?php
$koneksi->query("DELETE FROM pengguna WHERE idpengguna='$_GET[id]'");
echo "<script>alert('Data Pengguna Berhasil Di Hapus');</script>";
echo "<script>location='penggunadaftar.php';</script>";
