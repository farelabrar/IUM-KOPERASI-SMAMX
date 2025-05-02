<?php 
    $id = $_SESSION['admin']['id_member'];
    $hasil = $lihat -> member_edit($id);
?>
<div class="row mb-4">
        <div class="col-md-12">
             <h3 class="font-weight-bold text-dark">Transaksi</h3>
        </div>
    </div>
<br>
<?php if(isset($_GET['success'])){?>
<div class="alert alert-success">
    <p>Edit Data Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
    <p>Hapus Data Berhasil !</p>
</div>
<?php }?>

<div class="row">
    <div class="col-sm-4">
        <div class="card card-primary mb-3">
            <div class="card-header bg-primary text-white">
                <h5><i class="fa fa-search"></i> Cari Barang</h5>
            </div>
            <div class="card-body">
                <input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
                <div id="search_results" class="mt-3"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card card-primary mb-3">
            <div class="card-header bg-primary text-white">
                <h5><i class="fa fa-list"></i> Hasil Pencarian</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hasil_cari"></div>
                    <div id="tunggu"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-header bg-primary text-white">
                <h5><i class="fa fa-shopping-cart"></i> KASIR</h5>
            </div>
            <div class="card-body">
                <div id="keranjang" class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
                        </tr>
                    </table>
                    <table class="table table-bordered w-100" id="example1">
                        <thead>
                            <tr>
                                <td> No</td>
                                <td> Nama Barang</td>
                                <td style="width:10%;"> Jumlah</td>
                                <td style="width:20%;"> Total</td>
                                <td> Kasir</td>
                                <td> Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_bayar=0; $no=1; $hasil_penjualan = $lihat -> penjualan();?>
                            <?php foreach($hasil_penjualan as $isi){?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $isi['nama_barang'];?></td>
                                <td>
                                    <form method="POST" action="fungsi/edit/edit.php?jual=jual" class="update-form">
                                        <input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control">
                                        <input type="hidden" name="id" value="<?php echo $isi['id_penjualan'];?>" class="form-control">
                                        <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
                                </td>
                                <td>Rp.<?php echo number_format($isi['total']);?>,-</td>
                                <td><?php echo $isi['nm_member'];?></td>
                                <td>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    </form>
                                    <a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan'];?>&brg=<?php echo $isi['id_barang'];?>&jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php $no++; $total_bayar += $isi['total'];}?>
                        </tbody>
                    </table>
                    <br/>
                    <?php $hasil = $lihat -> jumlah(); ?>
                    <div id="kasirnya">
                        <table class="table table-stripped">
                            <?php
                            if(!empty($_GET['nota'] == 'yes')) {
                                $total = $_POST['total'];
                                $bayar = $_POST['bayar'];
                                if(!empty($bayar)) {
                                    $hitung = $bayar - $total;
                                    if($bayar >= $total) {
                                        $id_barang = $_POST['id_barang'];
                                        $id_member = $_POST['id_member'];
                                        $jumlah = $_POST['jumlah'];
                                        $total = $_POST['total1'];
                                        $tgl_input = $_POST['tgl_input'];
                                        $periode = $_POST['periode'];
                                        $jumlah_dipilih = count($id_barang);
                                        
                                        for($x=0;$x<$jumlah_dipilih;$x++){
                                            $d = array($id_barang[$x],$id_member[$x],$jumlah[$x],$total[$x],$tgl_input[$x],$periode[$x]);
                                            $sql = "INSERT INTO nota (id_barang,id_member,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
                                            $row = $config->prepare($sql);
                                            $row->execute($d);

                                            $sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
                                            $row_barang = $config->prepare($sql_barang);
                                            $row_barang->execute(array($id_barang[$x]));
                                            $hsl = $row_barang->fetch();
                                            
                                            $stok = $hsl['stok'];
                                            $idb  = $hsl['id_barang'];

                                            $total_stok = $stok - $jumlah[$x];
                                            $sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                                            $row_stok = $config->prepare($sql_stok);
                                            $row_stok->execute(array($total_stok, $idb));
                                        }
                                    } else {
                                        echo '<script>alert("Uang Kurang! Rp.'.$hitung.'");</script>';
                                    }
                                }
                            }
                            ?>
                            <form method="POST" action="index.php?page=jual&nota=yes#kasirnya" id="paymentForm">
                                <?php foreach($hasil_penjualan as $isi){;?>
                                    <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
                                    <input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
                                    <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
                                    <input type="hidden" name="total1[]" value="<?php echo $isi['total'];?>">
                                    <input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input'];?>">
                                    <input type="hidden" name="periode[]" value="<?php echo date('m-Y');?>">
                                <?php $no++; }?>
                                <tr>
                                    <td>Total Semua</td>
                                    <td><input type="text" class="form-control" name="total" id="total" value="<?php echo $total_bayar;?>" readonly></td>
                                
                                    <td>Bayar</td>
                                    <td><input type="number" class="form-control" name="bayar" id="bayar" required></td>
                                    <td>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>
                                        <?php if(isset($_GET['nota']) && $_GET['nota'] == 'yes'): ?>
                                            <a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>&bayar=<?php echo isset($bayar) ? $bayar : ''; ?>&kembali=<?php echo isset($hitung) ? $hitung : ''; ?>" target="_blank" class="btn btn-sm btn-info">Cetak Struk</a>
                                        <?php endif; ?>
                                        <?php if(!empty($_GET['nota'] == 'yes')) {?>
                                            <a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual"><b>RESET</b></a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kembali</td>
                                    <td><input type="text" class="form-control" id="kembali" readonly></td>
                                    <td colspan="2"></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    // Inisialisasi DataTable tanpa paging dan fitur lainnya
    $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false
    });

    // Variabel untuk menyimpan keyword pencarian terakhir
    var lastSearchKeyword = '';
    
    // AJAX untuk pencarian barang
    $("#cari").on('input', function(){
        lastSearchKeyword = $(this).val();
        if(lastSearchKeyword.length > 0) {
            $.ajax({
                type: "POST",
                url: "fungsi/edit/edit.php?cari_barang=yes",
                data: {'keyword': lastSearchKeyword},
                beforeSend: function(){
                    $("#hasil_cari").hide();
                    $("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
                },
                success: function(html){
                    $("#tunggu").html('');
                    $("#hasil_cari").show();
                    $("#hasil_cari").html(html);
                }
            });
        } else {
            $("#hasil_cari").html('');
        }
    });

    // Fungsi untuk memuat ulang hasil pencarian
    function reloadSearchResults() {
        if(lastSearchKeyword.length > 0) {
            $.ajax({
                type: "POST",
                url: "fungsi/edit/edit.php?cari_barang=yes",
                data: {'keyword': lastSearchKeyword},
                success: function(html){
                    $("#hasil_cari").html(html);
                }
            });
        }
    }

    // Hitung kembalian otomatis
    $('#bayar').on('input', function() {
        var total = parseFloat($('#total').val()) || 0;
        var bayar = parseFloat($(this).val()) || 0;
        var kembali = bayar - total;
        
        $('#kembali').val(kembali >= 0 ? 'Rp.' + kembali.toLocaleString('id-ID') + ',-' : 'Rp.0,-');
    });

    // Validasi form pembayaran
    $('#paymentForm').on('submit', function(e) {
        var total = parseFloat($('#total').val()) || 0;
        var bayar = parseFloat($('#bayar').val()) || 0;
        
        if (bayar < total) {
            e.preventDefault();
            alert('Uang pembayaran kurang!');
            return false;
        }
    });
    
    // Auto reset setelah pembayaran berhasil
    <?php if(isset($_GET['nota']) && $_GET['nota'] == 'yes'): ?>
    setTimeout(function() {
        window.location.href = 'fungsi/hapus/hapus.php?penjualan=jual';
    }, 5000);
    <?php endif; ?>

    // Handle ketika barang ditambahkan ke keranjang
    $(document).on('submit', '.tambah-keranjang', function(e) {
        e.preventDefault();
        var form = $(this);
        
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                // Reload keranjang belanja
                location.reload();
                // Mempertahankan hasil pencarian
                reloadSearchResults();
            }
        });
    });

    // Handle update jumlah barang di keranjang
    $(document).on('submit', '.update-form', function(e) {
        e.preventDefault();
        var form = $(this);
        
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                // Reload keranjang belanja
                location.reload();
                // Mempertahankan hasil pencarian
                reloadSearchResults();
            }
        });
    });
});
</script>