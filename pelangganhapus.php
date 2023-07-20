<?php include('koneksi.php'); ?>
<?php
$koneksi->query("DELETE FROM pelanggan WHERE idpelanggan='$_GET[id]'");
echo "<script>alert('Data Pelanggan Berhasil Di Hapus');</script>";
echo "<script>location='pelanggandaftar.php';</script>";
