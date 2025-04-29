<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Dashboard</h3>
    </div>

    <?php 
    // Check low stock items
    $sql = "SELECT * FROM barang WHERE stok <= 3";
    $row = $config->prepare($sql);
    $row->execute();
    $r = $row->rowCount();
    
    if($r > 0){
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <i class='fas fa-exclamation-triangle mr-2'></i>
            Ada <span class='font-weight-bold text-danger'>$r</span> barang yang stok tersisa sudah kurang dari 3 items. 
            <a href='index.php?page=barang&stok=yes' class='alert-link'>Cek sekarang!</a>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }

    // Get statistics
    $hasil_barang = $lihat->barang_row();
    $hasil_kategori = $lihat->kategori_row();
    $stok = $lihat->barang_stok_row();
    $jual = $lihat->jual_row();
    
    // Get recent transactions
    $sql_recent = "SELECT nota.*, barang.nama_barang, member.nm_member 
                   FROM nota 
                   INNER JOIN barang ON nota.id_barang = barang.id_barang
                   INNER JOIN member ON nota.id_member = member.id_member 
                   ORDER BY tanggal_input DESC LIMIT 5";
    $row_recent = $config->prepare($sql_recent);
    $row_recent->execute();
    $recent_transactions = $row_recent->fetchAll();

    // Menghitung pendapatan hari ini menggunakan format tanggal yang sesuai
    $today = date('Y-m-d');
    $today_format = date('d F Y'); // Format yang sesuai dengan fungsi hari_jual()
    $param = "%{$today_format}%";
    $sql_revenue = "SELECT SUM(total) as bayar FROM nota WHERE tanggal_input LIKE ?";
    $row_revenue = $config->prepare($sql_revenue);
    $row_revenue->execute([$param]);
    $revenue_today = $row_revenue->fetch()['bayar'];
    ?>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($hasil_barang);?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href='index.php?page=barang' class="text-primary">
                        Detail <i class='fa fa-angle-right'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Stok Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($stok['jml']);?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href='index.php?page=barang' class="text-success">
                        Detail <i class='fa fa-angle-right'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Terjual</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jual['stok']);?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href='index.php?page=laporan' class="text-info">
                        Detail <i class='fa fa-angle-right'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendapatan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?php echo number_format($revenue_today ?? 0);?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href='index.php?page=laporan' class="text-warning">
                        Detail <i class='fa fa-angle-right'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Transactions -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
                    <a href="index.php?page=laporan" class="btn btn-sm btn-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Kasir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_transactions as $trans): ?>
                                <tr>
                                    <td><?php echo date('d/m/Y H:i', strtotime($trans['tanggal_input']));?></td>
                                    <td><?php echo $trans['nama_barang'];?></td>
                                    <td><?php echo $trans['jumlah'];?></td>
                                    <td>Rp <?php echo number_format($trans['total']);?></td>
                                    <td><?php echo $trans['nm_member'];?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add any custom JavaScript here
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $(".alert").fadeOut("slow");
    }, 5000);
});
</script>