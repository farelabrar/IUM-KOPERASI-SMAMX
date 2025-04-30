<?php 
    $bulan_tes = array(
        '01'=>"Januari",
        '02'=>"Februari",
        '03'=>"Maret",
        '04'=>"April",
        '05'=>"Mei",
        '06'=>"Juni",
        '07'=>"Juli",
        '08'=>"Agustus",
        '09'=>"September",
        '10'=>"Oktober",
        '11'=>"November",
        '12'=>"Desember"
    );
?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h4 class="font-weight-bold text-dark">
                <?php if(!empty($_GET['cari'])): ?>
                Laporan Penjualan <?= $bulan_tes[$_POST['bln']]; ?> <?= $_POST['thn']; ?>
                <?php elseif(!empty($_GET['hari'])): ?>
                Laporan Penjualan <?= $_POST['hari']; ?>
                <?php else: ?>
                Laporan Penjualan <?= $bulan_tes[date('m')]; ?> <?= date('Y'); ?>
                <?php endif; ?>
            </h4>
           
        </div>
    </div>

    <!-- Search Cards -->
    <div class="row mb-4">
        <!-- Monthly Report Search -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-calendar-alt mr-2"></i>Cari Laporan Bulanan
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?page=laporan&cari=ok">
                        <div class="form-row align-items-center">
                            <div class="col-md-5 mb-2">
                                <select name="bln" class="form-control" required>
                                    <option value="" selected disabled>Pilih Bulan</option>
                                    <?php
                                    $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                    $bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                    for($c=0; $c<count($bulan); $c+=1){
                                        echo "<option value='$bln1[$c]'>$bulan[$c]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-5 mb-2">
                                <?php
                                $now = date('Y');
                                echo "<select name='thn' class='form-control' required>";
                                echo '<option value="" selected disabled>Pilih Tahun</option>';
                                for ($a=2017; $a<=$now; $a++) {
                                    echo "<option value='$a'>$a</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="hidden" name="periode" value="ya">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-6">
                                <a href="index.php?page=laporan" class="btn btn-success btn-block">
                                    <i class="fas fa-sync-alt mr-1"></i>Refresh
                                </a>
                            </div>
                            <div class="col-6">
                                <?php if(!empty($_GET['cari'])): ?>
                                <a href="excel.php?cari=yes&bln=<?=$_POST['bln'];?>&thn=<?=$_POST['thn'];?>" class="btn btn-info btn-block">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                                <?php else: ?>
                                <a href="excel.php" class="btn btn-info btn-block">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daily Report Search -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-calendar-day mr-2"></i>Cari Laporan Harian
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?page=laporan&hari=cek">
                        <div class="form-row align-items-center">
                            <div class="col-md-10 mb-2">
                                <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" name="hari" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="hidden" name="periode" value="ya">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-6">
                                <a href="index.php?page=laporan" class="btn btn-success btn-block">
                                    <i class="fas fa-sync-alt mr-1"></i>Refresh
                                </a>
                            </div>
                            <div class="col-6">
                                <?php if(!empty($_GET['hari'])): ?>
                                <a href="excel.php?hari=cek&tgl=<?= $_POST['hari']; ?>" class="btn btn-info btn-block">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                                <?php else: ?>
                                <a href="excel.php" class="btn btn-info btn-block">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-table mr-2"></i>Detail Laporan Penjualan
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">ID Barang</th>
                            <th>Nama Barang</th>
                            <th width="8%">Jumlah</th>
                            <th width="12%">Modal</th>
                            <th width="12%">Total</th>
                            <th width="15%">Kasir</th>
                            <th width="15%">Tanggal Input</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1; 
                        $bayar = 0;
                        $modal = 0;
                        $jumlah = 0;
                        
                        if(!empty($_GET['cari'])){
                            $periode = $_POST['bln'].'-'.$_POST['thn'];
                            $hasil = $lihat->periode_jual($periode);
                        } elseif(!empty($_GET['hari'])){
                            $hari = $_POST['hari'];
                            $hasil = $lihat->hari_jual($hari);
                        } else {
                            $hasil = $lihat->jual();
                        }
                        
                        foreach($hasil as $isi): 
                            $bayar += $isi['total'];
                            $modal += $isi['harga_beli'] * $isi['jumlah'];
                            $jumlah += $isi['jumlah'];
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $isi['id_barang']; ?></td>
                            <td><?= $isi['nama_barang']; ?></td>
                            <td class="text-center"><?= $isi['jumlah']; ?></td>
                            <td class="text-right">Rp <?= number_format($isi['harga_beli'] * $isi['jumlah']); ?></td>
                            <td class="text-right">Rp <?= number_format($isi['total']); ?></td>
                            <td><?= $isi['nm_member']; ?></td>
                            <td><?= $isi['tanggal_input']; ?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                    <tfoot class="font-weight-bold">
                        <tr>
                            <th colspan="3">Total Terjual</th>
                            <th class="text-center"><?= $jumlah; ?></th>
                            <th class="text-right">Rp <?= number_format($modal); ?></th>
                            <th class="text-right">Rp <?= number_format($bayar); ?></th>
                            <th class="bg-success text-white">Keuntungan</th>
                            <th class="bg-success text-white">Rp <?= number_format($bayar - $modal); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>