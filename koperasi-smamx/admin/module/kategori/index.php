<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
             <h3 class="font-weight-bold text-dark">Kategori</h3>
        </div>
    </div>
    <!-- Notification Alerts -->
    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <p class="mb-0"><i class="fas fa-check-circle mr-2"></i>Tambah Data Berhasil!</p>
    </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['success-edit'])): ?>
    <div class="alert alert-success">
        <p class="mb-0"><i class="fas fa-check-circle mr-2"></i>Update Data Berhasil!</p>
    </div>
    <?php endif; ?>
    
    <?php if(isset($_GET['remove'])): ?>
    <div class="alert alert-danger">
        <p class="mb-0"><i class="fas fa-trash-alt mr-2"></i>Hapus Data Berhasil!</p>
    </div>
    <?php endif; ?>

    <!-- Form Tambah Kategori (Muncul saat pertama kali) -->
    <?php if(empty($_GET['uid'])): ?>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Tambah Kategori Baru</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="fungsi/tambah/tambah.php?kategori=tambah">
                <div class="form-row align-items-center">
                    <div class="col-md-9 mb-2">
                        <input type="text" class="form-control" required name="kategori"
                            placeholder="Masukkan nama kategori baru">
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-plus mr-2"></i>Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Form Edit Kategori (Muncul hanya saat edit) -->
    <?php 
    if(!empty($_GET['uid'])){
        $sql = "SELECT * FROM kategori WHERE id_kategori = ?";
        $row = $config->prepare($sql);
        $row->execute(array($_GET['uid']));
        $edit = $row->fetch();
    ?>
    <div class="card mb-4">
        <div class="card-header bg-warning">
            <h6 class="m-0 font-weight-bold">Ubah Data Kategori</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="fungsi/edit/edit.php?kategori=edit">
                <div class="form-row align-items-center">
                    <div class="col-md-9 mb-2">
                        <input type="text" class="form-control" value="<?= $edit['nama_kategori']; ?>"
                            required name="kategori" placeholder="Masukkan nama kategori">
                        <input type="hidden" name="id" value="<?= $edit['id_kategori']; ?>">
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="submit" class="btn btn-warning btn-block">
                            <i class="fa fa-save mr-2"></i>Simpan Perubahan
                        </button>
                        <a href="index.php?page=kategori" class="btn btn-secondary btn-block mt-2">
                            <i class="fa fa-times mr-2"></i>Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Daftar Kategori</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No.</th>
                            <th>Kategori</th>
                            <th width="20%">Tanggal Input</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $hasil = $lihat->kategori();
                            $no = 1;
                            foreach($hasil as $isi):
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $isi['nama_kategori']; ?></td>
                            <td><?= $isi['tgl_input']; ?></td>
                            <td class="text-center">
                                <a href="index.php?page=kategori&uid=<?= $isi['id_kategori']; ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit mr-1"></i>Edit
                                </a>
                                <a href="fungsi/hapus/hapus.php?kategori=hapus&id=<?= $isi['id_kategori']; ?>" 
                                   onclick="return confirm('Hapus Data Kategori ?');"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash mr-1"></i>Hapus
                                </a>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>