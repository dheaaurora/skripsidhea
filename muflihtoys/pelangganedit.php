<?php include 'header.php';
include('koneksi.php');
if ($_SESSION['admin']['level'] == "Kasir") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE idpelanggan='$_GET[id]'");
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
                                <h5 class="m-b-10">Ubah Pelanggan</h5>
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
                                            <h5>Data Pelanggan</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" value="<?= $pecah['nama'] ?>" name="nama" placeholder="Nama Pelanggan">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required class="form-control" value="<?= $pecah['email'] ?>" name="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">No. Telepon</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" required class="form-control" value="<?= $pecah['nohp'] ?>" name="nohp" placeholder="No. Telepon">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <textarea required class="form-control" name="alamat" placeholder="Alamat"><?= $pecah['alamat'] ?></textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="tambah">Simpan</button>
                                            </form>
                                            <?php
                                            if (isset($_POST['tambah'])) {
                                                $koneksi->query("UPDATE pelanggan SET nama='$_POST[nama]',email='$_POST[email]', nohp='$_POST[nohp]', alamat='$_POST[alamat]' WHERE idpelanggan='$_GET[id]'") or die(mysqli_error($koneksi));
                                                echo "<script> alert('Pelanggan Sudah Diupdate');</script>";
                                                echo "<script> location ='pelanggandaftar.php';</script>";
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