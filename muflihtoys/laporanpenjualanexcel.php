<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pegawai.xls");
?>
<html>
<title>Laporan Penjualan Roti Emak</title>
<?php
include('koneksi.php');
function rupiah($angka)
{
    $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilrupiah;
}
if (isset($_POST['submit'])) {
    $tanggalawal = $_POST['tanggalawal'];
    $tanggalakhir = $_POST['tanggalakhir'];
} else {
    $hariini = date('Y-m-d');
    $tanggalawal = date('Y-m-01', strtotime($hariini));
    $tanggalakhir = date('Y-m-01', strtotime($hariini));
}
?>

<body>
    <!-- <center>
        <img src="foto/koplogo.png" width="680px">
        <h2>Laporan Penjualan Barang</h2>
        <h4><?= date("d-m-Y", strtotime($tanggalawal)) . ' - ' . date("d-m-Y", strtotime($tanggalakhir)) ?></h4>
    </center> -->
    <br>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Nota</th>
                <th>Tanggal</th>
                <th width="30%">Daftar Barang</th>
                <th>Total Belanja</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1;
            if (isset($_POST['submit'])) {
                $tanggalawal = $_POST['tanggalawal'];
                $tanggalakhir = $_POST['tanggalakhir'];
                $ambil = $koneksi->query("SELECT*FROM penjualan WHERE (tanggalpenjualan >= '$tanggalawal' and tanggalpenjualan <= '$tanggalakhir') group by notajual");
                $ambilpembelian = $koneksi->query("SELECT*FROM pembelian WHERE (tanggalpembelian >= '$tanggalawal' and tanggalpembelian <= '$tanggalakhir') group by notabeli");
            } else {
                $ambil = $koneksi->query("SELECT*FROM penjualan group by notajual");
                $ambilpembelian = $koneksi->query("SELECT*FROM pembelian group by notabeli");
            }
            $totalpemasukan = 0;
            ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo substr($pecah['notajual'], 0, 4) . '' . $pecah['idpenjualan'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($pecah['tanggalpenjualan'])) ?></td>
                    <td>
                        <?php
                        $ambildaftarbarang = $koneksi->query("SELECT*FROM penjualan where notajual = '$pecah[notajual]'");
                        while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
                            <?php
                            echo $daftarbarang['namabarang'] . ' x ' . $daftarbarang['jumlah'] ?>,
                        <?php } ?>
                    </td>
                    <td><?php echo rupiah($pecah['grandtotal']) ?></td>
                </tr>
                <?php
                $totalpemasukan += $pecah['grandtotal'];
                $nomor++; ?>
            <?php } ?>
        </tbody>
        <?php
        $totalpengeluaran = 0;
        while ($pecahpengeluaran = $ambilpembelian->fetch_assoc()) { ?>
            <?php
            $totalpengeluaran += $pecahpengeluaran['grandtotal']; ?>
        <?php } ?>
        <tfoot>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="biru" colspan="1" style="align-items: right" align="right"><em>Total Pemasukan :</em></td>
                <td class="biru"><?= rupiah($totalpemasukan) ?></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td class="biru" colspan="1" style="align-items: right" align="right"><em>Total Modal :</em></td>
                <td class="biru"><?= rupiah($totalpengeluaran) ?></td>
            </tr>
            <?php if ($totalpemasukan > $totalpengeluaran) { ?>
                <tr>
                    <td colspan="3"></td>
                    <td class="biru" colspan="1" style="align-items: right" align="right"><em><b>Laba :</b></em></td>
                    <td class="biru"><?= rupiah($totalpemasukan - $totalpengeluaran) ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td class="biru" colspan="1" style="align-items: right" align="right"><em><b>Rugi :</b></em></td>
                    <td class="biru"><?= rupiah(0) ?></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td colspan="3"></td>
                    <td class="biru" colspan="1" style="align-items: right" align="right"><em><b>Laba :</b></em></td>
                    <td class="biru"><?= rupiah(0) ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td class="biru" colspan="1" style="align-items: right" align="right"><em><b>Rugi :</b></em></td>
                    <td class="biru"><?= rupiah($totalpemasukan - $totalpengeluaran) ?></td>
                </tr>
            <?php } ?>
        </tfoot>
    </table>
</body>

</html>