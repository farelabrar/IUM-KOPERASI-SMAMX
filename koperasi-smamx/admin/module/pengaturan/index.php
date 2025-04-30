<div class="container-fluid">
    <!-- Notification Alert (preserved with improved styling) -->
    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-2"></i> Perubahan data berhasil disimpan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- Settings Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-store mr-2"></i>Informasi Sekolah
            </h6>
        </div>
        <div class="card-body">
            <!-- Original Form (functionality preserved) -->
            <form method="post" action="fungsi/edit/edit.php?pengaturan=ubah">
                <div class="row">
                    <div class="col-md-6">
                        <!-- School Name Field -->
                        <div class="form-group">
                            <label class="font-weight-bold">Nama Sekolah</label>
                            <input type="text" class="form-control" name="namatoko" 
                                   value="<?php echo htmlspecialchars($toko['nama_toko']); ?>"
                                   placeholder="Masukkan nama sekolah" required>
                        </div>
                        
                        <!-- City Field -->
                        <div class="form-group">
                            <label class="font-weight-bold">Kota</label>
                            <textarea class="form-control" name="alamat" rows="3"
                                      placeholder="Masukkan alamat lengkap sekolah" required><?php echo htmlspecialchars($toko['alamat_toko']); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <!-- Contact Field -->
                        <div class="form-group">
                            <label class="font-weight-bold">Kontak (Telepon/HP)</label>
                            <input type="text" class="form-control" name="kontak" 
                                   value="<?php echo htmlspecialchars($toko['tlp']); ?>"
                                   placeholder="Contoh: 081234567890" required>
                        </div>
                        
                        <!-- Principal Field -->
                        <div class="form-group">
                            <label class="font-weight-bold">Kepala Sekolah</label>
                            <input type="text" class="form-control" name="pemilik" 
                                   value="<?php echo htmlspecialchars($toko['nama_pemilik']); ?>"
                                   placeholder="Masukkan nama kepala sekolah" required>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="row mt-4">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>