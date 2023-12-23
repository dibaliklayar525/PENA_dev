<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> - <?= CodeIgniter\CodeIgniter::APP_NAME ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/dist/css/adminlte.min.css">
</head>


<body class="hold-transition login-page">

    <!-- CONTENT DISINI -->
    <?= $this->renderSection('login_content'); ?>

    <!-- jQuery -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('adminLTE3') ?>/dist/js/adminlte.min.js"></script>
</body>

</html>