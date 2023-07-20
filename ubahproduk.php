<?php include 'header.php';
include('koneksi.php');
$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<!-- page content -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Ubah Produk</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">

                        <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Produk</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nama Produk</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?= $pecah['namaproduk'] ?>" class="form-control" name="namaproduk" placeholder="Nama Produk">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Stok</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" value="<?= $pecah['stok'] ?>" required class="form-control" name="stok" placeholder="Stok">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Harga Jual</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" value="<?= $pecah['hargajual'] ?>" required class="form-control" name="hargajual" placeholder="Harga Jual">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Foto</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" required class="form-control" name="foto" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <img src="foto/<?php echo $pecah['foto'] ?>" width="100px">
                                                    </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="tambah">Simpan</button>
                                            </form>
                                            <?php
                                            if (isset($_POST['tambah'])) {
                                                $namafoto = $_FILES['foto']['name'];
                                                $lokasifoto = $_FILES['foto']['tmp_name'];
                                                move_uploaded_file($lokasifoto, "foto/$namafoto");
                                                $koneksi->query("UPDATE produk SET namaproduk='$_POST[namaproduk]',stok='$_POST[stok]', hargajual='$_POST[hargajual]', foto='$namafoto' WHERE idproduk='$_GET[id]'") or die(mysqli_error($koneksi));
                                                echo "<script> alert('Produk Sudah Diupdate');</script>";
                                                echo "<script> location ='daftarproduk.php';</script>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>