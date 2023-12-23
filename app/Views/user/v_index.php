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
                                <a href="<?= base_url('user/add') ?>"
                                    class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-plus"></i> tambah
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- table -->
                            <table id="tbl_user" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Departemen</th>
                                        <th>Sub Departemen</th>
                                        <th>Avatar</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($user as $value) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['nama_user'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['level_name'] ?></td>
                                        <td><?= $value['nama_dep'] ?></td>
                                        <td><?= $value['nama_sub_dep'] ?></td>
                                        <td><img src="<?= base_url('img/avatar') ?>/<?= $value['avatar'] ?>"
                                                alt="<?= $value['avatar'] ?>" width="50"></td>
                                        <td><a href="<?= base_url('user/edit') ?>/<?= encrypt_url($value['id_user']) ?>"
                                                title="Edit" class="btn btn-sm btn-outline-warning"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-outline-danger" id="delete"
                                                delete_atribut="<?= $value['id_user'] ?>" title="Hapus"><i
                                                    class="fa fa-eraser"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>
<?php
// alert
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
<script>
// table
$(document).ready(function() {
    $('#tbl_user').DataTable();
});
/* -------------------  Delete ------------------------*/
$(document).on("click", "#delete", function(e) {
    e.preventDefault();

    let del_id = $(this).attr("delete_atribut");

    Swal.fire({
        title: "Yakin menghapus kategori?",
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
                url: "<?= base_url('user/delete'); ?>",
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