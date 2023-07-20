<?php include('header.php'); ?>

<!-- page content -->
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Daftar Penjualan Produk</h5>
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
                            <h5>Daftar Penjualan Produk</h5>
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
                                            <th class="text-center">Nota</th>
                                            <th class="text-center">Pelanggan</th>
                                            <th class="text-center">Tanggal</th>
                                            <th width="30%" class="text-center">Produk</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Bukti Pembayaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php $ambil = $koneksi->query("SELECT*FROM penjualan join pelanggan on penjualan.idpelanggan = pelanggan.idpelanggan group by notajual order by tanggalpenjualan desc, notajual desc");
                                        $totalpemasukan = 0;
                                        ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $nomor; ?></td>
                                                <td><?php echo $pecah['kodenota'] ?></td>
                                                <td><?php echo $pecah['namapelanggan'] ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($pecah['tanggalpenjualan'])) ?></td>
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
                                                        $ambildaftarbarang = $koneksi->query("SELECT*FROM penjualan join produk on penjualan.idproduk = produk.idproduk where notajual = '$pecah[notajual]'");
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
                                                    <a class="btn btn-info text-white m-1" href="cetaknota.php?id=<?php echo $pecah['notajual']; ?>" target="_blank">Nota</a>
                                                    <a class="btn btn-warning text-white mb-1" href="penjualanretur.php?id=<?= $pecah['notajual'] ?>">Retur</a>
                                                    <a href="penjualanhapus.php?id=<?php echo $pecah['notajual']; ?>" class="btn btn-danger m-1" onclick="return confirm('Yakin Mau di Hapus?')">Hapus</a>
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
                                                                <input type="hidden" name="notajual" class="form-control" value="<?= $pecah['notajual'] ?>" required>
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
                                            $totalpemasukan += $grandtotal;
                                            $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="5" class="text-right"><em>Total Pemasukan :</em></th>
                                        <th colspan="3"><?= rupiah($totalpemasukan) ?></th>
                                    </tfoot>
                                </table>
                                <?php $no = 1; ?>
                                <?php $ambilmodal = $koneksi->query("SELECT*FROM penjualan join pelanggan on penjualan.idpelanggan = pelanggan.idpelanggan group by notajual order by tanggalpenjualan desc, notajual desc"); ?>
                                <?php while ($pecahmodal = $ambilmodal->fetch_assoc()) { ?>
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
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Barang</th>
                                                                <th>Harga</th>
                                                                <th>Jumlah</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $nobelanja = 1;
                                                            $ambildaftarbarangdetail = $koneksi->query("SELECT*FROM penjualan join produk on penjualan.idproduk = produk.idproduk where notajual = '$pecahmodal[notajual]'");
                                                            while ($daftarbarangdetail = $ambildaftarbarangdetail->fetch_assoc()) { ?>
                                                                <tr>
                                                                    <td><?php echo $nobelanja; ?></td>
                                                                    <td><?php echo $daftarbarangdetail['namaproduk'] ?></td>
                                                                    <td><?php echo rupiah($daftarbarangdetail['harga']) ?></td>
                                                                    <td><?php echo $daftarbarangdetail['jumlah'] ?></td>
                                                                    <td><?= rupiah($daftarbarangdetail['harga'] * $daftarbarangdetail['jumlah']) ?></td>
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
    $notajual = $_POST["notajual"];
    $status = 'Di Setujui';
    $koneksi->query("UPDATE penjualan SET buktipembayaran='$namafoto' WHERE notajual='$notajual'") or die(mysqli_error($koneksi));
    echo "<script> alert('Bukti Pembayaran berhasil di simpan');</script>";
    echo "<script> location ='penjualandaftar.php';</script>";
}
?>