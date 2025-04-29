<!--main content start-->
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="index.php?page=barang" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Barang
            </a>
            <h4 class="font-weight-bold text-dark">Edit Data Barang</h4>
        </div>
    </div>

    <?php 
        $id = $_GET['barang'];
        $hasil = $lihat->barang_edit($id);
    ?>

    <!-- Notification Alerts -->
    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-2"></i>Data berhasil diperbarui!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['remove'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-trash-alt mr-2"></i>Data berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- Form Edit Barang -->
    <div class="card shadow">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">Form Edit Barang</h6>
        </div>
        <div class="card-body">
            <form action="fungsi/edit/edit.php?barang=edit" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID Barang</label>
                            <input type="text" readonly class="form-control" value="<?= $hasil['id_barang']; ?>" name="id">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="<?= $hasil['id_kategori']; ?>"><?= $hasil['nama_kategori']; ?></option>
                                <?php foreach($lihat->kategori() as $isi): ?>
                                    <?php if($isi['id_kategori'] != $hasil['id_kategori']): ?>
                                        <option value="<?= $isi['id_kategori']; ?>"><?= $isi['nama_kategori']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" value="<?= $hasil['nama_barang']; ?>" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Merk Barang</label>
                            <input type="text" class="form-control" value="<?= $hasil['merk']; ?>" name="merk" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Beli</label>
                            <input type="number" class="form-control" value="<?= $hasil['harga_beli']; ?>" name="beli" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input type="number" class="form-control" value="<?= $hasil['harga_jual']; ?>" name="jual" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Satuan Barang</label>
                            <select name="satuan" class="form-control" required>
                                <option value="<?= $hasil['satuan_barang']; ?>"><?= $hasil['satuan_barang']; ?></option>
                                <option value="PCS">PCS</option>
                                <!-- Tambahkan opsi satuan lainnya jika ada -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" class="form-control" value="<?= $hasil['stok']; ?>" name="stok" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tanggal Update</label>
                    <input type="text" readonly class="form-control" value="<?= date("j F Y, G:i"); ?>" name="tgl">
                </div>
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>