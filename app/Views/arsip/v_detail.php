<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
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
                            <h3 class="card-title">
                                <i class="fa fa-folder"></i>
                                <?= $detail['nama_kategori'] . ' - ' . $detail['nama_kategori_sub']  ?>
                            </h3>
                            <div class="card-tools">
                                <?= $detail['nama_dep'] . ' / ' . $detail['nama_sub_dep']  ?></div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <tr>
                                    <th>Judul</th>
                                    <th>:</th>
                                    <th> <?= $detail['nama_file'] ?></th>
                                </tr>
                                <tr>
                                    <th>No. Surat</th>
                                    <th>:</th>
                                    <th> <?= $detail['no_arsip'] ?></th>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</th>
                                    <th>:</th>
                                    <th><?= tgl_indo($detail['tgl_surat']) ?></th>
                                </tr>
                                <tr>
                                    <th>file</th>
                                    <th>:</th>
                                    <th><?= $detail['file_arsip'] ?></th>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th>:</th>
                                    <th><?= $detail['deskripsi'] ?></th>
                                </tr>
                            </table>

                            <hr>

                            <div class="col-12 col-md-12">
                                <iframe src="<?= base_url('file') . '/' . $detail['file_arsip'] ?>" style="border:none;" title="<? $detail['file_arsip'] ?>" width="100%" height="500"></iframe>

                            </div>

                        </div>
                        <div class="card-footer">
                            <span class="text-muted small"> di upload pada tanggal
                                : <?= tglIndo($detail['tgl_upload']) ?></span>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>