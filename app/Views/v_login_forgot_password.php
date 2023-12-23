<?= $this->extend('layout_login/template_login'); ?>
<?= $this->section('login_content'); ?>
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b><?= CodeIgniter\CodeIgniter::APP_NAME ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg"><?= $title ?> <?= CodeIgniter\CodeIgniter::APP_LONG_NAME ?></p>
            <form action="recover-password.html" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="<?= base_url() ?>">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<?= $this->endSection() ?>