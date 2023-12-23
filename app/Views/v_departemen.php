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
                            <div class="card-tools">
                                <button type="button" class="btn btn-outline-primary btn-block btn-sm"
                                    data-toggle="modal" data-target="#tambahdep"><i class="fa fa-plus"></i> tambah
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <!-- search -->
                            <div class="col-6">
                                <form action="<?= base_url('departemen') ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari <?= $title ?>..."
                                            name="keyword">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit"
                                                name="submit_search">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- table -->
                            <table id="tbl_kategori" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Departemen</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + ($limit * ($current_page - 1)); ?>
                                    <?php foreach ($tbl_dep as $value) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['nama_dep'] ?></td>
                                        <td><button type="button" title="Edit" class="btn btn-sm btn-outline-warning"
                                                data-toggle="modal" data-target="#edit<?= $value['id_dep'] ?>">
                                                <i class="fa fa-edit"></i></button>
                                            <a class="btn btn-sm btn-outline-danger" id="delete"
                                                delete_atribut="<?= $value['id_dep'] ?>" title="Hapus"><i
                                                    class="fa fa-eraser"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                            <!-- pagination -->
                            <div class="py-3">
                                <?= $pager->links('tbl_dep', 'pagination_dep') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>

<!-- Modal add kategori -->
<div class="modal fade" id="tambahdep">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open(base_url('departemen/add')) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="departemen">Departemen</label>
                    <input type="text" class="form-control" id="nama_dep" name="nama_dep"
                        placeholder="Nama Departemen disini.." maxlength="255">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-outline-light">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal edit kategori -->
<?php foreach ($tbl_dep as $value) : ?>
<div class="modal fade" id="edit<?= $value['id_dep'] ?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open(base_url('departemen/edit/' . (int)$value['id_dep'] . '')) ?>
                <div class="form-group">
                    <label for="departemen">Departemen</label>
                    <input type="text" class="form-control" id="nama_dep" name="nama_dep"
                        value="<?= $value['nama_dep'] ?>" placeholder="Nama departemen disini.." maxlength="255">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-outline-light">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- php -->
<?php
// alert kategori
if (session()->getFlashdata('pesan')) {
    echo $output = "
    <script>
    Swal.fire(
        'Berhasil',
        '" . session()->getFlashdata('pesan') . "',
        'success'
      )
    </script>";
}
?>

<!-- Script Javascript -->

<script>
/* -------------------  Delete ------------------------*/
$(document).on("click", "#delete", function(e) {
    e.preventDefault();

    let del_id = $(this).attr("delete_atribut");

    Swal.fire({
        title: "Yakin menghapus Departemen?",
        text: "Data yang dihapus tidak dapat dikembalikan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?= base_url('departemen/delete'); ?>",
                data: {
                    del_id: del_id,
                },
                dataType: "json",
                success: function(data) {
                    if (data.response == "success") {
                        Swal.fire(
                            "Success",
                            "Data telah dihapus. ",
                            "success"
                        );
                    }
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(data) {
                    alert("error");
                }
            });
        }
    });
});
</script>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>