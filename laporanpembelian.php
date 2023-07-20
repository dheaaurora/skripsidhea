<?php include('header.php');
if ($_SESSION['admin']['level'] != "Owner") {
    echo "<script> alert('Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini');</script>";
    echo "<script> location ='index.php';</script>";
}
if (isset($_POST['submit'])) {
    $tanggalawal = $_POST['tanggalawal'];
    $tanggalakhir = $_POST['tanggalakhir'];
} else {
    $hariini = date('Y-m-d');
    $tanggalawal = date('Y-m-01', strtotime($hariini));
    $tanggalakhir = date('Y-m-t', strtotime($hariini));
}
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
                                <h5 class="m-b-10">Laporan Pembelian</h5>
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
                                            <h5>Data Laporan Pembelian</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post">
                                                <div class="row mt-3 mb-3">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Tanggal Awal</label>
                                                            <input type="date" class="form-control" name="tanggalawal" value="<?= $tanggalawal ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Tanggal Awal</label>
                                                            <input type="date" class="form-control" name="tanggalakhir" value="<?= $tanggalakhir ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <button type="submit" name="submit" value="submit" class="btn btn-primary text-white mt-4 btn-block">Cari</button>
                                                        </div>
                                                    </div>
                                            </form>
                                            <form method="post" action="laporanpembeliancetak.php" target="_blank">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="tanggalawalfix" value="<?= $tanggalawal ?>" required>
                                                        <input type="hidden" class="form-control" name="tanggalakhirfix" value="<?= $tanggalakhir ?>" required>
                                                        <button type="submit" class="btn btn-success text-white mt-4">Cetak</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <table class="table table-bordered table-striped" id="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <!-- <th>No. Nota</th> -->
                                                    <th class="text-center">Tanggal Pembelian</th>
                                                    <th width="30%" class="text-center">Nama Produk</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Total</th>
                                                    <!-- <th>Detail</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $nomor = 1;
                                                if (isset($_POST['submit'])) {
                                                    $tanggalawal = $_POST['tanggalawal'];
                                                    $tanggalakhir = $_POST['tanggalakhir'];
                                                    $ambil = $koneksi->query("SELECT*FROM pembelian join produk on pembelian.idproduk = produk.idproduk WHERE (tanggalpembelian >= '$tanggalawal' and tanggalpembelian <= '$tanggalakhir')");
                                                } else {
                                                    $ambil = $koneksi->query("SELECT*FROM pembelian join produk on pembelian.idproduk = produk.idproduk WHERE (tanggalpembelian >= '$tanggalawal' and tanggalpembelian <= '$tanggalakhir') ");
                                                }
                                                $totalpengeluaran = 0;
                                                ?>
                                                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $nomor; ?></td>
                                                        <!-- <td><?php echo substr($pecah['notabeli'], 0, 4) . '' . $pecah['idpembelian'] ?></td> -->
                                                        <td class="text-center"><?php echo date("d-m-Y", strtotime($pecah['tanggalpembelian'])) ?></td>
                                                        <td class="text-center"><?php echo $pecah['namaproduk'] ?></td>
                                                        <td class="text-center">
                                                            <?= rupiah($pecah['harga']) ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $pecah['jumlah'] ?>
                                                        </td>
                                                        <td><?= rupiah($pecah['harga'] * $pecah['jumlah']) ?></td>
                                                    </tr>
                                                    <?php
                                                    $totalpengeluaran += $pecah['harga'] * $pecah['jumlah'];
                                                    $nomor++; ?>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <th colspan="5" class="text-right"><em>Total Pengeluaran :</em></th>
                                                <th colspan="2"><?= rupiah($totalpengeluaran) ?></th>
                                            </tfoot>
                                        </table>
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
<?php include('footer.php'); ?>