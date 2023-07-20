<?php include('koneksi.php');
if ($_SESSION['admin']['level'] != "Admin") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
?>
<?php
$koneksi->query("DELETE FROM retur WHERE notabeli='$_GET[id]'");
echo "<script>alert('Data Retur Berhasil Di Hapus');</script>";
echo "<script>location='returdaftar.php';</script>";
