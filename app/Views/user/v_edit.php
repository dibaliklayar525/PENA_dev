<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <?= $title ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data <?= $title ?></h3>
                        </div>

                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>