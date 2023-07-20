<?php include('koneksi.php'); ?>
<?php
$koneksi->query("DELETE FROM penjualan WHERE notajual='$_GET[id]'");
$koneksi->query("DELETE FROM penjualanretur WHERE notajual='$_GET[id]'");
echo "<script>alert('Data Penjualan Berhasil Di Hapus');</script>";
echo "<script>location='penjualandaftar.php';</script>";
