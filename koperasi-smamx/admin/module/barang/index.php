<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
        <h3 class="font-weight-bold text-dark">Barang</h3>
        </div>
    </div>

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

    <!-- Stok Warning -->
    <?php 
        $sql = "SELECT * FROM barang WHERE stok <= 3";
        $row = $config->prepare($sql);
        $row->execute();
        $r = $row->rowCount();
        if($r > 0):
    ?>
    <div class="alert alert-warning alert-dismissible fade show">
        <i class="fas fa-exclamation-triangle mr-2"></i> 
        Ada <span class="font-weight-bold text-danger"><?= $r; ?></span> barang yang stok tersisa kurang dari 3. Silahkan pesan lagi!
        <a href="index.php?page=barang&stok=yes" class="float-right font-weight-bold">
            Cek Barang <i class="fas fa-angle-double-right ml-1"></i>
        </a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <div class="mb-4">
        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#tambahBarangModal">
            <i class="fas fa-plus mr-2"></i>Tambah Barang
        </button>
        <a href="index.php?page=barang&stok=yes" class="btn btn-warning mr-2">
            <i class="fas fa-list mr-2"></i>Stok Kurang
        </a>
        <a href="index.php?page=barang" class="btn btn-success">
            <i class="fas fa-sync-alt mr-2"></i>Refresh
        </a>
    </div>

    <!-- Data Table -->
    <div class="card shadow">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">Daftar Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%">No</th>
                            <th width="10%">ID Barang</th>
                            <th width="12%">Kategori</th>
                            <th>Nama Barang</th>
                            <th width="10%">Merk</th>
                            <th width="8%">Stok</th>
                            <th width="12%">Harga Beli</th>
                            <th width="12%">Harga Jual</th>
                            <th width="8%">Satuan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $totalBeli = 0;
                            $totalJual = 0;
                            $totalStok = 0;
                            $hasil = ($_GET['stok'] == 'yes') ? $lihat->barang_stok() : $lihat->barang();
                            $no = 1;
                            foreach($hasil as $isi):
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $isi['id_barang']; ?></td>
                            <td><?= $isi['nama_kategori']; ?></td>
                            <td><?= $isi['nama_barang']; ?></td>
                            <td><?= $isi['merk']; ?></td>
                            <td class="text-center">
                                <?php if($isi['stok'] == '0'): ?>
                                    <span class="badge badge-danger">Habis</span>
                                <?php else: ?>
                                    <?= $isi['stok']; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-right">Rp <?= number_format($isi['harga_beli']); ?></td>
                            <td class="text-right">Rp <?= number_format($isi['harga_jual']); ?></td>
                            <td class="text-center"><?= $isi['satuan_barang']; ?></td>
                            <td class="text-center">
                                <?php if($isi['stok'] <= '3'): ?>
                                <form method="POST" action="fungsi/edit/edit.php?stok=edit" class="form-inline">
                                    <input type="number" name="restok" class="form-control form-control-sm mr-1" style="width:60px;" min="1">
                                    <input type="hidden" name="id" value="<?= $isi['id_barang']; ?>">
                                    <button type="submit" class="btn btn-sm btn-primary mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?= $isi['id_barang']; ?>" 
                                       onclick="return confirm('Hapus Data barang?');"
                                       class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </form>
                                <?php else: ?>
                                <div class="btn-group">
                                    <a href="index.php?page=barang/details&barang=<?= $isi['id_barang']; ?>" 
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="index.php?page=barang/edit&barang=<?= $isi['id_barang']; ?>" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?= $isi['id_barang']; ?>" 
                                       onclick="return confirm('Hapus Data barang?');"
                                       class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php 
                            $no++; 
                            $totalBeli += $isi['harga_beli'] * $isi['stok']; 
                            $totalJual += $isi['harga_jual'] * $isi['stok'];
                            $totalStok += $isi['stok'];
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot class="font-weight-bold">
                        <tr>
                            <td colspan="5">Total</td>
                            <td class="text-center"><?= $totalStok; ?></td>
                            <td class="text-right">Rp <?= number_format($totalBeli); ?></td>
                            <td class="text-right">Rp <?= number_format($totalJual); ?></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Barang Modal -->
<div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahBarangModalLabel">
                    <i class="fas fa-plus mr-2"></i>Tambah Barang Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="fungsi/tambah/tambah.php?barang=tambah" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Barang</label>
                                <input type="text" readonly class="form-control" value="<?= $lihat->barang_id(); ?>" name="id">
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($lihat->kategori() as $kat): ?>
                                    <option value="<?= $kat['id_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" placeholder="Nama Barang" required name="nama">
                            </div>
                            <div class="form-group">
                                <label>Merk Barang</label>
                                <input type="text" class="form-control" placeholder="Merk Barang" required name="merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control" placeholder="Harga Beli" required name="beli" min="0">
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="number" class="form-control" placeholder="Harga Jual" required name="jual" min="0">
                            </div>
                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <select name="satuan" class="form-control" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="PCS">PCS</option>
                                    <!-- Tambahkan opsi satuan lainnya jika ada -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Stok Awal</label>
                                <input type="number" class="form-control" placeholder="Stok" required name="stok" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input type="text" readonly class="form-control" value="<?= date("j F Y, G:i"); ?>" name="tgl">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>