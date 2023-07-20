<?php include('header.php');
if ($_SESSION['admin']['level'] != "Owner") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
?>
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Daftar Pengguna</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Daftar Pengguna</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                    <li><i class="fa fa-window-maximize full-card"></i></li>
                                    <li><i class="fa fa-minus minimize-card"></i></li>
                                    <li><i class="fa fa-refresh reload-card"></i></li>
                                    <li><i class="fa fa-trash close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Pengguna</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1;
                                        $idpengguna = $_SESSION['admin']['idpengguna'];
                                        ?>
                                        <?php $ambil = $koneksi->query("SELECT*FROM pengguna where idpengguna != '$idpengguna'"); ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo $pecah['namapengguna'] ?></td>
                                                <td><?= $pecah['email'] ?></td>
                                                <td><?= $pecah['level'] ?></td>
                                                <td>
                                                    <a href="penggunaedit.php?id=<?php echo $pecah['idpengguna']; ?>" class="btn btn-success m-1">Edit</a>
                                                    <a href="penggunahapus.php?id=<?php echo $pecah['idpengguna']; ?>" class="btn btn-danger m-1" onclick="return confirm('Yakin Mau di Hapus?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php include('footer.php'); ?>