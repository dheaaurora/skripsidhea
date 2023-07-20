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
                                <h5 class="m-b-10">Tambah Pembelian</h5>
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
                                            <h5>Data Pembelian</h5>
                                        </div>
                                        <div class="card-block">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" name="tanggalpembelian" type="date" required value="<?= date('Y-m-d') ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Nama Supplier</label>
                                                    <div class="col-sm-10">
                                                        <select name="idsupplier" class="form-control" required>
                                                            <option value="">Pilih Supplier</option>
                                                            <?php $ambilsupplier = $koneksi->query("SELECT*FROM supplier"); ?>
                                                            <?php while ($supplier = $ambilsupplier->fetch_assoc()) { ?>
                                                                <option value="<?= $supplier['idsupplier'] ?>"><?= $supplier['namasupplier'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <table class="table table-bordered table-striped" id="dynamic_field">
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="form-group idprodukharga">
                                                                <label>Nama Produk</label>
                                                                <select name="idproduk[]" class="form-control idproduk" required>
                                                                    <option value="">Pilih Produk</option>
                                                                    <?php $ambil = $koneksi->query("SELECT*FROM produk "); ?>
                                                                    <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                                                        <option value="<?= $pecah['idproduk'] ?>" data-price="<?= $pecah['hargajual'] ?>"><?= $pecah['namaproduk'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Harga</label>
                                                                <input type="text" id="harga1" name="harga[]" oninput="check()" onchange="check()" class="form-control" required>
                                                            </div>
                                                        </td>
                                                        <td width="15%">
                                                            <div class="form-group">
                                                                <label>Jumlah</label>
                                                                <input type="number" value="1" min="0" id="jumlah1" name="jumlah[]" oninput="check()" onchange="check()" class="form-control" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Total</label>
                                                                <input type="text" id="total1" name="total[]" value="0" class="form-control total" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <button type="button" name="add" id="addkegiatan" class="btn btn-success mt-4">+</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Grand Total</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" id="grandtotal" name="grandtotal" type="number" readonly>
                                                        <input class="form-control" id="grandtotalnon" name="grandtotalnon" type="hidden">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bukti Pembayaran</label>
                                                    <input type="file" class="form-control" name="foto">
                                                </div>
                                                <button type="submit" required class="btn btn-primary float-right pull-right" name="simpan" value="simpan">Simpan</button>
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
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        $namafoto = $_FILES['foto']['name'];
        move_uploaded_file($lokasifoto, "foto/" . $namafoto);
    } else {
        $namafoto = "";
    }
    $idsupplier = $_POST['idsupplier'];
    $tanggalpembelian = $_POST['tanggalpembelian'];
    $grandtotal = $_POST['grandtotalnon'];
    $notabeli = date("Ymdhis");
    $i = 0;
    foreach ($_POST['idproduk'] as $val) {
        $idproduk = $_POST['idproduk'][$i];
        $harga = $_POST['harga'][$i];
        $jumlah = $_POST['jumlah'][$i];
        $total = $_POST['total'][$i];
        $koneksi->query("INSERT INTO pembelian(idsupplier,notabeli,idproduk,harga,jumlah,total,tanggalpembelian,grandtotal,buktipembayaran)
		VALUES ('$idsupplier','$notabeli','$idproduk','$harga','$jumlah','$total','$tanggalpembelian','$grandtotal','$namafoto')") or die(mysqli_error($koneksi));
        $koneksi->query("UPDATE produk SET stok=stok+'$jumlah' WHERE idproduk='$idproduk'") or die(mysqli_error($koneksi));
        $i++;
    }
    echo "<script> alert('Pembelian Barang Berhasil Disimpan');</script>";
    echo "<script> location ='pembeliandaftar.php';</script>";
}
?>
<script>
    var $submit = $('#btn_simpan');

    $(document).ready(function() {
        var i = 1;
        $('#addkegiatan').click(function() {

            i++;
            html = "";
            html += '<tr id="row' + i + '">' +

                '<td width="30%">' +
                '<div class="form-group idprodukharga">' +
                '<label>Nama Barang</label>' +
                '<select name="idproduk[]" class="form-control idproduk" required>' +
                '<option value="">Pilih Barang</option>' +
                '<?php $ambil = $koneksi->query("SELECT*FROM produk"); ?>' +
                '<?php while ($pecah = $ambil->fetch_assoc()) { ?>' +
                '<option value="<?= $pecah['idproduk'] ?>"><?= $pecah['namaproduk'] ?></option>' +
                '<?php } ?>' +
                '</select>' +
                '</div>' +
                '</td>' +

                '<td>' +
                '<div class="form-group">' +
                '<label>Harga</label>' +
                '<input type="text" id="harga' + i + '" name="harga[]" class="form-control" oninput="check()" onchange="check()" required>' +
                '</div>' +
                '</td>' +

                '<td width="15%">' +
                '<div class="form-group">' +
                '<label>Jumlah</label>' +
                '<input type="number" value="1" min="0" id="jumlah' + i + '" name="jumlah[]" class="form-control" oninput="check()" onchange="check()" required>' +
                '</div>' +
                '</td>' +

                '<td>' +
                '<div class="form-group">' +
                '<label>Total</label>' +
                '<input type="text" id="total' + i + '" name="total[]" class="form-control total" value="0" readonly>' +
                '</div>' +
                '</td>' +

                '<td>' +
                '<div class="form-group">' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove mt-4">X</button>' +
                '</div>' +
                '</td>' +


                '</tr>';

            $('#dynamic_field').append(html);
        });

    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $(document).ready(function() {
        $(".total").each(function() {
            setInterval(hitunggrandtotal, 100);
        });

    });

    function hitunggrandtotal() {
        var sum = 0;
        $(".total").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }

        });
        document.getElementById('grandtotal').value = sum.toFixed(2);
        document.getElementById('grandtotalnon').value = sum;

        var jumlah1 = document.getElementById('jumlah1').value;
        var harga1 = document.getElementById('harga1').value;
        var total1 = parseInt(jumlah1) * parseInt(harga1);
        if (!isNaN(total1)) {
            document.getElementById('total1').value = total1;
        } else {
            document.getElementById('total1').value = 0;
        }

        var jumlah2 = document.getElementById('jumlah2').value;
        var harga2 = document.getElementById('harga2').value;
        var total2 = parseInt(jumlah2) * parseInt(harga2);
        if (!isNaN(total2)) {
            document.getElementById('total2').value = total2;
        } else {
            document.getElementById('total2').value = 0;
        }

        var jumlah3 = document.getElementById('jumlah3').value;
        var harga3 = document.getElementById('harga3').value;
        var total3 = parseInt(jumlah3) * parseInt(harga3);
        if (!isNaN(total3)) {
            document.getElementById('total3').value = total3;
        } else {
            document.getElementById('total3').value = 0;
        }

        var jumlah4 = document.getElementById('jumlah4').value;
        var harga4 = document.getElementById('harga4').value;
        var total4 = parseInt(jumlah4) * parseInt(harga4);
        if (!isNaN(total4)) {
            document.getElementById('total4').value = total4;
        } else {
            document.getElementById('total4').value = 0;
        }

        var jumlah5 = document.getElementById('jumlah5').value;
        var harga5 = document.getElementById('harga5').value;
        var total5 = parseInt(jumlah5) * parseInt(harga5);
        if (!isNaN(total5)) {
            document.getElementById('total5').value = total5;
        } else {
            document.getElementById('total5').value = 0;
        }

        var jumlah6 = document.getElementById('jumlah6').value;
        var harga6 = document.getElementById('harga6').value;
        var total6 = parseInt(jumlah6) * parseInt(harga6);
        if (!isNaN(total6)) {
            document.getElementById('total6').value = total6;
        } else {
            document.getElementById('total6').value = 0;
        }

        var jumlah7 = document.getElementById('jumlah7').value;
        var harga7 = document.getElementById('harga7').value;
        var total7 = parseInt(jumlah7) * parseInt(harga7);
        if (!isNaN(total7)) {
            document.getElementById('total7').value = total7;
        } else {
            document.getElementById('total7').value = 0;
        }

        var jumlah8 = document.getElementById('jumlah8').value;
        var harga8 = document.getElementById('harga8').value;
        var total8 = parseInt(jumlah8) * parseInt(harga8);
        if (!isNaN(total8)) {
            document.getElementById('total8').value = total8;
        } else {
            document.getElementById('total8').value = 0;
        }

        var jumlah9 = document.getElementById('jumlah9').value;
        var harga9 = document.getElementById('harga9').value;
        var total9 = parseInt(jumlah9) * parseInt(harga9);
        if (!isNaN(total9)) {
            document.getElementById('total9').value = total9;
        } else {
            document.getElementById('total9').value = 0;
        }

        var jumlah10 = document.getElementById('jumlah10').value;
        var harga10 = document.getElementById('harga10').value;
        var total10 = parseInt(jumlah10) * parseInt(harga10);
        if (!isNaN(total10)) {
            document.getElementById('total10').value = total10;
        } else {
            document.getElementById('total10').value = 0;
        }

        var jumlah11 = document.getElementById('jumlah11').value;
        var harga11 = document.getElementById('harga11').value;
        var total11 = parseInt(jumlah11) * parseInt(harga11);
        if (!isNaN(total11)) {
            document.getElementById('total11').value = total11;
        } else {
            document.getElementById('total11').value = 0;
        }

        var jumlah12 = document.getElementById('jumlah12').value;
        var harga12 = document.getElementById('harga12').value;
        var total12 = parseInt(jumlah12) * parseInt(harga12);
        if (!isNaN(total12)) {
            document.getElementById('total12').value = total12;
        } else {
            document.getElementById('total12').value = 0;
        }

        var jumlah13 = document.getElementById('jumlah13').value;
        var harga13 = document.getElementById('harga13').value;
        var total13 = parseInt(jumlah13) * parseInt(harga13);
        if (!isNaN(total13)) {
            document.getElementById('total13').value = total13;
        } else {
            document.getElementById('total13').value = 0;
        }

        var jumlah14 = document.getElementById('jumlah14').value;
        var harga14 = document.getElementById('harga14').value;
        var total14 = parseInt(jumlah14) * parseInt(harga14);
        if (!isNaN(total14)) {
            document.getElementById('total14').value = total14;
        } else {
            document.getElementById('total14').value = 0;
        }
    }
</script>