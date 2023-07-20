<?php include 'header.php';
include('koneksi.php');
$ambil = $koneksi->query("SELECT*FROM pembelian join supplier on pembelian.idsupplier = supplier.idsupplier where notabeli='$_GET[id]' group by notabeli");
$row = $ambil->fetch_assoc();
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
                                <h5 class="m-b-10">Retur Pembelian</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="page-body">
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Data Pembelian</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td width="30%">
                                                            Tanggal Pembelian
                                                        </td>
                                                        <td>
                                                            <?= tanggal($row['tanggalpembelian']) ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%">
                                                            Supplier
                                                        </td>
                                                        <td>
                                                            <?= $row['namasupplier'] ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <br>
                                            <table class="table table-bordered table-striped">
                                                <thead class="bg-primary text-white">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Total Harga</th>
                                                        <th>Retur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $grandtotal = 0;
                                                    $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelian join produk on pembelian.idproduk = produk.idproduk where notabeli = '$_GET[id]'");
                                                    while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td width="40%"><?= $daftarbarang['namaproduk'] ?></td>
                                                            <td width="30%"><?= rupiah($daftarbarang['harga']) ?></td>
                                                            <td width="10%"><?= $daftarbarang['jumlah'] ?></td>
                                                            <td width="25%"><?= rupiah($daftarbarang['harga'] * $daftarbarang['jumlah']) ?></td>
                                                            <td>
                                                                <a class="btn btn-warning" data-toggle="modal" data-target="#retur<?= $no ?>">Retur</a>
                                                            </td>
                                                        </tr>
                                                        <!-- retur -->
                                                        <div class="modal fade" id="retur<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Retur Produk</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form method="post">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Masukkan jumlah retur</label>
                                                                                <input type="hidden" class="form-control" name="notabeli" value="<?= $daftarbarang['notabeli'] ?>" required>
                                                                                <input type="hidden" class="form-control" name="idpembelian" value="<?= $daftarbarang['idpembelian'] ?>" required>
                                                                                <input type="hidden" class="form-control" name="idproduk" value="<?= $daftarbarang['idproduk'] ?>" required>
                                                                                <input type="hidden" class="form-control jumlahlama" name="jumlahlama" value="<?= $daftarbarang['jumlah'] ?>" required>

                                                                                <input type="number" class="form-control jumlahbaru" name="jumlah" value="0" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="simpan" class="btn btn-primary">Simpan Retur</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                    <?php
                                                        $grandtotal += $daftarbarang['harga'] * $daftarbarang['jumlah'];
                                                        $no++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Riwayat Retur</h5>
                                        </div>
                                        <div class="card-block">
                                            <table class="table table-bordered table-striped">
                                                <thead class="bg-primary text-white">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Jumlah</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelianretur join produk on pembelianretur.idproduk = produk.idproduk where notabeli = '$_GET[id]'") or die(mysqli_error($koneksi));
                                                    while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $daftarbarang['namaproduk'] ?></td>
                                                            <td><?php echo $daftarbarang['jumlah'] ?></td>
                                                            <td>
                                                                <a class="btn btn-danger text-white" data-toggle="modal" data-target="#hapusretur<?= $no ?>">Hapus</a>
                                                            </td>
                                                        </tr>
                                                        <!-- retur -->
                                                        <div class="modal fade" id="hapusretur<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapus data retur ini, jumlah stok pembelian akan dikembalikan</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form method="post">
                                                                        <div class="modal-footer">
                                                                            <input type="hidden" class="form-control" name="idpembelianretur" value="<?= $daftarbarang['idpembelianretur'] ?>" required>
                                                                            <input type="hidden" class="form-control" name="notabeli" value="<?= $daftarbarang['notabeli'] ?>" required>
                                                                            <input type="hidden" class="form-control" name="idpembelian" value="<?= $daftarbarang['idpembelian'] ?>" required>
                                                                            <input type="hidden" class="form-control" name="idproduk" value="<?= $daftarbarang['idproduk'] ?>" required>
                                                                            <input type="hidden" class="form-control" name="jumlah" value="<?= $daftarbarang['jumlah'] ?>" required>
                                                                            <button type="submit" name="hapus" class="btn btn-danger">Hapus Retur</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                    <?php
                                                        $no++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                            </form>
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
<?php
if (isset($_POST['simpan'])) {
    $idpembelian = $_POST['idpembelian'];
    $notabeli = $_POST['notabeli'];
    $idproduk = $_POST['idproduk'];
    $jumlah = $_POST['jumlah'];
    if ($jumlah >= 1) {
        $koneksi->query("UPDATE pembelian SET jumlah=jumlah-'$jumlah' WHERE idpembelian='$idpembelian'") or die(mysqli_error($koneksi));
        $koneksi->query("UPDATE produk SET stok=stok-'$jumlah' WHERE idproduk='$idproduk'") or die(mysqli_error($koneksi));
        $koneksi->query("INSERT INTO pembelianretur(notabeli,idpembelian,idproduk,jumlah)
    VALUES ('$notabeli','$idpembelian','$idproduk','$jumlah')") or die(mysqli_error($koneksi));
    }
    echo "<script> alert('Retur Berhasil Disimpan');</script>";
    echo "<script> location ='pembelianretur.php?id=$notabeli';</script>";
}
if (isset($_POST['hapus'])) {
    $idpembelianretur  = $_POST['idpembelianretur'];
    $idpembelian = $_POST['idpembelian'];
    $notabeli = $_POST['notabeli'];
    $idproduk = $_POST['idproduk'];
    $jumlah = $_POST['jumlah'];
    $koneksi->query("UPDATE pembelian SET jumlah=jumlah+'$jumlah' WHERE idpembelian='$idpembelian'") or die(mysqli_error($koneksi));
    $koneksi->query("UPDATE produk SET stok=stok+'$jumlah' WHERE idproduk='$idproduk'") or die(mysqli_error($koneksi));
    $koneksi->query("DELETE FROM pembelianretur WHERE idpembelianretur ='$idpembelianretur'");

    echo "<script> alert('Retur Berhasil Dihapus');</script>";
    echo "<script> location ='pembelianretur.php?id=$notabeli';</script>";
}
?>
<script>
    // Get all elements with class 'jumlahlama' and 'jumlahbaru'
    const jumlahLamaInputs = document.querySelectorAll('.jumlahlama');
    const jumlahBaruInputs = document.querySelectorAll('.jumlahbaru');

    // Attach event listeners to each 'jumlahbaru' input
    jumlahBaruInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            // Get the corresponding 'jumlahlama' input
            const jumlahLamaInput = this.closest('div').querySelector('.jumlahlama');

            // Get the values from both inputs
            const jumlahBaru = parseInt(this.value);
            const jumlahLama = parseInt(jumlahLamaInput.value);

            // Check if jumlahbaru is greater than jumlahlama
            if (jumlahBaru > jumlahLama) {
                // Set the value of jumlahbaru to the value of jumlahlama
                this.value = jumlahLama;
            }
        });
    });
</script>