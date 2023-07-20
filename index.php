<?php
include 'header.php';
include('koneksi.php');
$produk = $koneksi->query("SELECT*FROM produk");
$jumlahproduk = mysqli_num_rows($produk);

$bulanini = date('m');
$pembelian = $koneksi->query("SELECT * FROM pembelian where month(tanggalpembelian) = '$bulanini'");
$totalpembelian = 0;
while ($jumlahpembelian = $pembelian->fetch_assoc()) {
        $totalpembelian += $jumlahpembelian['jumlah'] * $jumlahpembelian['harga'];
}

$penjualan = $koneksi->query("SELECT * FROM penjualan where month(tanggalpenjualan) = '$bulanini'");
$totalpenjualan = 0;
while ($jumlahpenjualan = $penjualan->fetch_assoc()) {
        $totalpenjualan += $jumlahpenjualan['jumlah'] * $jumlahpenjualan['harga'];
}

?>
<div class="pcoded-content">
        <div class="page-header">
                <div class="page-block">
                        <div class="row align-items-center">
                                <div class="col-md-8">
                                        <div class="page-header-title">
                                                <h5 class="m-b-10">Selamat Datang Di Dashboard</h5>

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
                                                <?php if ($_SESSION['admin']['level'] == 'Admin' or $_SESSION['admin']['level'] == 'Owner') { ?>
                                                        <div class="col-xl-12 col-md-12">
                                                                <div class="card bg-c-green total-card">
                                                                        <div class="card-block">
                                                                                <div class="text-left">
                                                                                        <h4><?= $jumlahproduk ?></h4>
                                                                                        <p class="m-0">Data Produk</p>
                                                                                </div>
                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="daftarproduk.php">Selengkapnya</a>
                                                                        </div>
                                                                </div>
                                                                <div class="row">
                                                                        <div class="col-md-6">
                                                                                <div class="card bg-c-red total-card">
                                                                                        <div class="card-block">
                                                                                                <div class="text-left">
                                                                                                        <h4><?= rupiah($totalpembelian) ?></h4>
                                                                                                        <p class="m-0">Pembelian Bulan Ini</p>
                                                                                                </div>
                                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="pembeliandaftar.php">Selengkapnya</a>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                                <div class="card bg-c-blue total-card">
                                                                                        <div class="card-block">
                                                                                                <div class="text-left">
                                                                                                        <h4><?= rupiah($totalpenjualan) ?></h4>
                                                                                                        <p class="m-0">Penjualan Bulan Ini</p>
                                                                                                </div>
                                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="penjualandaftar.php">Selengkapnya</a>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                <?php } ?>
                                                <?php if ($_SESSION['admin']['level'] == 'Kasir') { ?>
                                                        <div class="col-xl-12 col-md-12">
                                                                <div class="card bg-c-green total-card">
                                                                        <div class="card-block">
                                                                                <div class="text-left">
                                                                                        <h4><?= $jumlahproduk ?></h4>
                                                                                        <p class="m-0">Data Produk</p>
                                                                                </div>
                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="daftarproduk.php">Selengkapnya</a>
                                                                        </div>
                                                                </div>
                                                                <div class="row">
                                                                        <div class="col-md-12">
                                                                                <div class="card bg-c-blue total-card">
                                                                                        <div class="card-block">
                                                                                                <div class="text-left">
                                                                                                        <h4><?= rupiah($totalpenjualan) ?></h4>
                                                                                                        <p class="m-0">Penjualan Bulan Ini</p>
                                                                                                </div>
                                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="penjualandaftar.php">Selengkapnya</a>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                <?php } ?>
                                                <?php if ($_SESSION['admin']['level'] == 'Admin') { ?>
                                                        <div class="col-xl-12 col-md-12">
                                                                <div class="card bg-c-green total-card">
                                                                        <div class="card-block">
                                                                                <div class="text-left">
                                                                                        <h4><?= $jumlahproduk ?></h4>
                                                                                        <p class="m-0">Data Produk</p>
                                                                                </div>
                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="daftarproduk.php">Selengkapnya</a>
                                                                        </div>
                                                                </div>
                                                                <div class="row">
                                                                        <div class="col-md-12">
                                                                                <div class="card bg-c-red total-card">
                                                                                        <div class="card-block">
                                                                                                <div class="text-left">
                                                                                                        <h4><?= rupiah($totalpembelian) ?></h4>
                                                                                                        <p class="m-0">Pembelian Bulan Ini</p>
                                                                                                </div>
                                                                                                <a class="btn btn-info btn-sm mt-3 pull-left float-left" href="pembeliandaftar.php">Selengkapnya</a>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                <?php } ?>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12">
                                                        <div class="card">
                                                                <div class="card-header">
                                                                        <h5 class="text-danger">Stok Warning, Produk dibawah 15</h5>
                                                                </div>
                                                                <div class="card-block table-border-style">
                                                                        <div class="table-responsive">
                                                                                <table class="table" id="table">
                                                                                        <thead class="bg-danger text-white">
                                                                                                <tr>
                                                                                                        <th>No</th>
                                                                                                        <th>Nama Produk</th>
                                                                                                        <th>Stok</th>
                                                                                                        <th>Foto</th>
                                                                                                </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                                <?php $nomor = 1; ?>
                                                                                                <?php $ambil = $koneksi->query("SELECT*FROM produk where stok <= 15"); ?>
                                                                                                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                                                                                        <tr class="text-danger">
                                                                                                                <td><?php echo $nomor; ?></td>
                                                                                                                <td><?php echo $pecah['namaproduk'] ?></td>
                                                                                                                <td><?php echo $pecah['stok'] ?></td>
                                                                                                                <td>
                                                                                                                        <img src="foto/<?php echo $pecah['foto'] ?>" width="100px">
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
                        </div>
                </div>
        </div>
</div>
<?php include 'footer.php'; ?>