<?php include 'header.php';
include('koneksi.php');
?>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tambah Pelanggan</h5>
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
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama Pelanggan">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" required class="form-control" name="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">No. Telepon</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" required class="form-control" name="nohp" placeholder="No. Telepon">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <textarea required class="form-control" name="alamat" placeholder="Alamat"></textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="tambah">Simpan</button>
                                            </form>
                                            <?php
                                            if (isset($_POST['tambah'])) {
                                                $nama = $_POST["nama"];
                                                $email = $_POST["email"];
                                                $nohp = $_POST["nohp"];
                                                $alamat = $_POST["alamat"];
                                                $koneksi->query("INSERT INTO pelanggan(namapelanggan, email, nohp, alamat)
		VALUES ('$nama', '$email', '$nohp', '$alamat')") or die(mysqli_error($koneksi));
                                                echo "<script> alert('Pelanggan Sudah Disimpan');</script>";
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