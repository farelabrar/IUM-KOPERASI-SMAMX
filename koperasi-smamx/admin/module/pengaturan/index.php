<div class="container-fluid">
   

    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i> Perubahan data berhasil disimpan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Informasi </h6>
            <i class="fas fa-store fa-2x text-gray-300"></i>
        </div>
        <div class="card-body">
            <form method="post" action="fungsi/edit/edit.php?pengaturan=ubah">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="namatoko" class="font-weight-bold">Nama Sekolah </label>
                            <input type="text" class="form-control border-primary" id="namatoko" name="namatoko" 
                                   value="<?php echo htmlspecialchars($toko['nama_toko']); ?>"
                                   placeholder="Masukkan nama toko" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Kota </label>
                            <textarea class="form-control border-primary" id="alamat" name="alamat" 
                                      rows="3" placeholder="Masukkan alamat lengkap toko" required><?php echo htmlspecialchars($toko['alamat_toko']); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kontak" class="font-weight-bold">Kontak (Telepon/HP)</label>
                            <input type="text" class="form-control border-primary" id="kontak" name="kontak" 
                                   value="<?php echo htmlspecialchars($toko['tlp']); ?>"
                                   placeholder="Contoh: 081234567890" required>
                        </div>
                        <div class="form-group">
                            <label for="pemilik" class="font-weight-bold">Kepala Sekolah</label>
                            <input type="text" class="form-control border-primary" id="pemilik" name="pemilik" 
                                   value="<?php echo htmlspecialchars($toko['nama_pemilik']); ?>"
                                   placeholder="Masukkan nama pemilik" required>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>