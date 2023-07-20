<?php include('header.php'); ?>


<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Daftar Pembelian</h5>
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
                            <h5>Daftar Pembelian</h5>
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
                                            <th class="text-center">No. Nota</th>
                                            <th class="text-center">Supplier</th>
                                            <th class="text-center">Tanggal Pembelian</th>
                                            <th width="30%" class="text-center">Daftar</th>
                                            <th class="text-center">Total Belanja</th>
                                            <th class="text-center">Bukti Pembayaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php $ambil = $koneksi->query("SELECT*FROM pembelian join supplier on pembelian.idsupplier = supplier.idsupplier group by notabeli order by tanggalpembelian desc, notabeli desc");
                                        $totalpengeluaran = 0;
                                        ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo $pecah['notabeli'] ?></td>
                                                <td><?php echo $pecah['namasupplier'] ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($pecah['tanggalpembelian'])) ?></td>
                                                <td width="40%">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <th>Produk</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        <?php
                                                        $grandtotal = 0;
                                                        $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelian join produk on pembelian.idproduk = produk.idproduk where notabeli = '$pecah[notabeli]'");
                                                        while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                                                            <tr>
                                                                <td width="40%"><?= $daftarbarang['namaproduk'] ?></td>
                                                                <td width="10%"><?= $daftarbarang['jumlah'] ?></td>
                                                                <td width="30%"><?= rupiah($daftarbarang['harga']) ?></td>
                                                                <td width="25%"><?= rupiah($daftarbarang['harga'] * $daftarbarang['jumlah']) ?></td>
                                                            </tr>
                                                        <?php
                                                            $grandtotal += $daftarbarang['harga'] * $daftarbarang['jumlah'];
                                                        } ?>
                                                    </table>
                                                </td>
                                                <td><?php echo rupiah($grandtotal) ?></td>
                                                <td>
                                                    <?php
                                                    if ($pecah['buktipembayaran'] != "") { ?>
                                                        <a href="#" data-toggle="modal" data-target="#modal<?php echo $nomor ?>">
                                                            <img src="foto/<?= $pecah['buktipembayaran'] ?>" width="150px">
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="#" data-toggle="modal" data-target="#modal<?php echo $nomor ?>" class="btn btn-success">
                                                            Upload Bukti Pembayaran
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success text-white m-1" data-toggle="modal" data-target="#detail<?= $nomor ?>">Detail</a>
                                                    <a class="btn btn-warning text-white mb-1" href="pembelianretur.php?id=<?= $pecah['notabeli'] ?>">Retur</a>
                                                    <a href="pembelianhapus.php?id=<?php echo $pecah['notabeli']; ?>" class="btn btn-danger m-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')">Hapus</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal<?php echo $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="notabeli" class="form-control" value="<?= $pecah['notabeli'] ?>" required>
                                                                <input type="file" name="foto" class="form-control" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $totalpengeluaran += $grandtotal;
                                            $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="5" class="text-right"><em>Total Pengeluaran :</em></th>
                                        <th colspan="3"><?= rupiah($totalpengeluaran) ?></th>
                                    </tfoot>
                                </table>
                                <?php $no = 1; ?>
                                <?php $ambilmodal = $koneksi->query("SELECT*FROM pembelian join supplier on pembelian.idsupplier = supplier.idsupplier group by notabeli order by tanggalpembelian desc, notabeli desc"); ?>
                                <?php while ($pecah = $ambilmodal->fetch_assoc()) { ?>
                                    <div class="modal fade" id="detail<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Daftar Belanja</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered table-striped" id="table2">
                                                        <thead class="bg-primary text-white">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $nobelanja = 1;
                                                            $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelian join produk on pembelian.idproduk = produk.idproduk where notabeli = '$pecah[notabeli]'");
                                                            while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                                                                <tr>
                                                                    <td><?php echo $nobelanja; ?></td>
                                                                    <td><?php echo $daftarbarang['namaproduk'] ?></td>
                                                                    <td><?php echo rupiah($daftarbarang['harga']) ?></td>
                                                                    <td><?php echo $daftarbarang['jumlah'] ?></td>
                                                                    <td width="25%"><?= rupiah($daftarbarang['harga'] * $daftarbarang['jumlah']) ?></td>
                                                                </tr>
                                                            <?php
                                                                $nobelanja++;
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $no++; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<?php
if (isset($_POST['simpan'])) {
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        $namafoto = $_FILES['foto']['name'];
        move_uploaded_file($lokasifoto, "foto/" . $namafoto);
    } else {
        $namafoto = "";
    }
    $notabeli = $_POST["notabeli"];
    $status = 'Di Setujui';
    $koneksi->query("UPDATE pembelian SET buktipembayaran='$namafoto' WHERE notabeli='$notabeli'") or die(mysqli_error($koneksi));
    echo "<script> alert('Bukti Pembayaran berhasil di simpan');</script>";
    echo "<script> location ='pembeliandaftar.php';</script>";
}
?>