<?php include('koneksi.php'); ?>
<?php
$koneksi->query("DELETE FROM produk WHERE idproduk='$_GET[id]'");
echo "<script>alert('Data Produk Berhasil Di Hapus');</script>";
echo "<script>location='daftarproduk.php';</script>";
