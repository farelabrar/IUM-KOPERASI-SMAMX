<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->
<?php 
    $id = $_SESSION['admin']['id_member'];
    $hasil = $lihat -> member_edit($id);
?>
<div class="container-fluid">
<div class="row mb-4">
        <div class="col-md-12">
        <h3 class="font-weight-bold text-dark">Profil Pengguna</h3>
        </div>
    </div>

    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i> Perubahan profil berhasil disimpan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['remove'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-trash-alt mr-2"></i> Data berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- Foto Profil -->
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle mr-2"></i>Foto Profil</h6>
                </div>
                <div class="card-body text-center">
                    <img src="assets/img/user/<?php echo htmlspecialchars($hasil['gambar']); ?>" 
                         alt="Foto Profil" 
                         class="img-fluid rounded-circle mb-3 border border-primary" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                    
                    <form method="POST" action="fungsi/edit/edit.php?gambar=user" enctype="multipart/form-data">
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" accept="image/*" name="foto" required>
                            <label class="custom-file-label" for="customFile">Pilih file...</label>
                        </div>
                        <input type="hidden" value="<?php echo htmlspecialchars($hasil['gambar']); ?>" name="foto2">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($hasil['id_member']); ?>">
                        
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-upload mr-2"></i>Unggah Foto Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Informasi Profil -->
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-edit mr-2"></i>Informasi Profil</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="fungsi/edit/edit.php?profil=edit">
                        <div class="form-group">
                            <label for="nama" class="font-weight-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   value="<?php echo htmlspecialchars($hasil['nm_member']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($hasil['email']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="telepon" class="font-weight-bold">Nomor Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="tlp" 
                                   value="<?php echo htmlspecialchars($hasil['telepon']); ?>" required>
                        </div>
                        
                     
                        
                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($hasil['alamat_member']); ?></textarea>
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($hasil['id_member']); ?>">
                        
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ganti Password -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-key mr-2"></i>Keamanan Akun</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="fungsi/edit/edit.php?pass=ganti-pas">
                        <div class="form-group">
                            <label for="username" class="font-weight-bold">Username</label>
                            <input type="text" class="form-control" id="username" name="user" 
                                   value="<?php echo htmlspecialchars($hasil['user']); ?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="pass" 
                                       placeholder="Masukkan password baru" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Minimal 8 karakter</small>
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($hasil['id_member']); ?>">
                        
                        <button type="submit" class="btn btn-primary btn-block" name="proses">
                            <i class="fas fa-lock mr-2"></i>Ganti Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Script untuk toggle password visibility
document.querySelectorAll('.toggle-password').forEach(function(button) {
    button.addEventListener('click', function() {
        const input = this.parentNode.previousElementSibling;
        const icon = this.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

// Script untuk custom file input
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = document.getElementById("customFile").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>