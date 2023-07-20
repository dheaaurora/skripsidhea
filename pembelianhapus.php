<?php include('koneksi.php');
?>
<?php
$koneksi->query("DELETE FROM pembelian WHERE notabeli='$_GET[id]'");
$koneksi->query("DELETE FROM pembelianretur WHERE notabeli='$_GET[id]'");
echo "<script>alert('Data Pembelian Berhasil Di Hapus');</script>";
echo "<script>location='pembeliandaftar.php';</script>";
