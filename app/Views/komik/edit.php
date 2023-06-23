<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <!-- error data -->
            <!-- <?php if (session('validation')) : ?>

                <?php foreach (session('validation')->getErrors() as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>

            <?php endif ?> -->
            <!-- error data -->
            <h5 class="my-3">Ubah Data Komik</h5>
            <form action="/komik/update/<?= $komik['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>" autofocus>
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
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id=" penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
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
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id=" penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
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
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id=" sampul" name="sampul" value="<?= (old('sampul')) ? old('sampul') : $komik['sampul'] ?>">
                        <!-- start notif validasi -->
                        <?php if (session('validation') && session('validation')->hasError('sampul')) : ?>
                            <div class="invalid-feedback">
                                <?= session('validation')->getError('sampul') ?>
                            </div>
                        <?php endif; ?>
                        <!-- end notif validasi -->
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>