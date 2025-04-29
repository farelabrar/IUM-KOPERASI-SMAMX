<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="index.php?page=barang" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Barang
            </a>
            <h4 class="font-weight-bold text-dark">Detail Barang</h4>
        </div>
    </div>

    <?php 
        $id = $_GET['barang'];
        $hasil = $lihat->barang_edit($id);
    ?>

    <!-- Notification Alerts -->
    <?php if(isset($_GET['success-stok'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-2"></i> Tambah Stok Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-2"></i> Tambah Data Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['remove'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-trash-alt mr-2"></i> Hapus Data Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- Item Details Card -->
    <div class="card shadow">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">Informasi Lengkap Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%" class="bg-light">ID Barang</th>
                            <td><?= $hasil['id_barang']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kategori</th>
                            <td><?= $hasil['nama_kategori']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Barang</th>
                            <td><?= $hasil['nama_barang']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Merk Barang</th>
                            <td><?= $hasil['merk']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Harga Beli</th>
                            <td>Rp <?= number_format($hasil['harga_beli']); ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Harga Jual</th>
                            <td>Rp <?= number_format($hasil['harga_jual']); ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Satuan Barang</th>
                            <td><?= $hasil['satuan_barang']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Stok Tersedia</th>
                            <td>
                                <?php if($hasil['stok'] <= 3): ?>
                                    <span class="badge badge-warning"><?= $hasil['stok']; ?> (Stok Rendah)</span>
                                <?php else: ?>
                                    <span class="badge badge-success"><?= $hasil['stok']; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Input</th>
                            <td><?= $hasil['tgl_input']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Update</th>
                            <td><?= $hasil['tgl_update'] ? $hasil['tgl_update'] : 'Belum pernah diupdate'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 text-right">
                <a href="index.php?page=barang/edit&barang=<?= $id; ?>" class="btn btn-warning mr-2">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
                <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?= $id; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');"
                   class="btn btn-danger">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Data
                </a>
            </div>
        </div>
    </div>
</div>