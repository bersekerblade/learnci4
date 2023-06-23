<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h5 class="my-3">Tambah Data Komik</h5>
            <form method="post" action="/komik/save/" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus>
                        <!-- start notif validasi -->
                        <?php if (session('validation') && session('validation')->hasError('judul')) : ?>
                            <div class="invalid-feedback">
                                <?= session('validation')->getError('judul'); ?>
                            </div>
                        <?php endif; ?>
                        <!-- end notif validasi -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <!-- start notif validasi -->
                        <?php if (session('validation') && session('validation')->hasError('penulis')) : ?>
                            <div class="invalid-feedback">
                                <?= session('validation')->getError('penulis'); ?>
                            </div>
                        <?php endif; ?>
                        <!-- end notif validasi -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        <!-- start notif validasi -->
                        <?php if (session('validation') && session('validation')->hasError('penerbit')) : ?>
                            <div class="invalid-feedback">
                                <?= session('validation')->getError('penerbit'); ?>
                            </div>
                        <?php endif; ?>
                        <!-- end notif validasi -->
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" id="sampul" name="sampul" class="custom-file-input <?= (session('validation')) ? 'is-invalid' : ''; ?>">
                            <!-- start notif validasi -->
                            <?php if (session('validation') && session('validation')->hasError('sampul')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('sampul'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- end notif validasi -->
                            <label class="custom-file-label" for="Sampul">pilih gambar</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>