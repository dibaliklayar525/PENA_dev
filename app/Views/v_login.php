<?= $this->extend('layout_login/template_login'); ?>
<?= $this->section('login_content'); ?>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= base_url('adminLTE3') ?>/index2.html"
                class="h1"><b><?= CodeIgniter\CodeIgniter::APP_NAME ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg"><?= $title ?> <?= CodeIgniter\CodeIgniter::APP_LONG_NAME ?></p>

            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) {
                foreach ($errors as $key => $value) {
                    echo $output = '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>' . esc($value) . '
                    </div>
                ';
                }
            } ?>
            <?php
            if (session()->getFlashdata('pesan')) {
                echo $output = '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>' . session()->getFlashdata('pesan') . '
                    </div>
                ';
            }
            ?>

            <?php echo form_open(base_url('auth-login')) ?>
            <div class="input-group mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12">
                <span class="text-muted text-center"> Development by <?= CodeIgniter\CodeIgniter::DEV_BY ?></span>
                </div>
                <!-- /.col -->
            </div>
            <?php echo form_close() ?>

            <!-- <p class="mb-1">
                <a href="<?= base_url('forgot-password') ?>">Saya lupa password</a>
            </p> -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<?= $this->endSection() ?>