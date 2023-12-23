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
                                <button type="button" class="btn btn-outline-primary btn-block btn-sm" data-toggle="modal" data-target="#tambahKategori"><i class="fa fa-plus"></i> tambah
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <!-- search -->
                            <div class="col-6">
                                <form action="<?= base_url('kategori') ?>" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari kategori..." name="keyword">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" name="submit_search">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- table -->
                            <table id="tbl_kategori" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 + ($limit * ($current_page - 1)); ?>
                                    <?php foreach ($tbl_kategori as $value) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['nama_kategori'] ?></td>
                                            <td><?= $value['nama_kategori_sub'] ?></td>
                                            <td><button type="button" title="Edit" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#edit<?= $value['id_kategori'] ?>">
                                                    <i class="fa fa-edit"></i></button>
                                                <a class="btn btn-sm btn-outline-danger" id="delete" delete_atribut="<?= $value['id_kategori'] ?>" title="Hapus"><i class="fa fa-eraser"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                            <!-- pagination -->
                            <div class="py-3">
                                <?= $pager->links('tbl_kategori', 'pagination_kategori') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>

<!-- Modal add  -->
<div class="modal fade" id="tambahKategori">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama kategori disini.." maxlength="255">
                    </div>

                    <select class="custom-select form-control-border" id="kategori_sub" name="kategori_sub" required style="width: 100%;">
                        <option>Sub Kategori</option>
                        <?php foreach ($subKategori as $value) : ?>
                            <option value="<?= $value['id'] ?>" id_kat_sub="<?= $value['id'] ?>">
                                <?= $value['id'] ?> |
                                <?= $value['nama_kategori_sub'] ?>
                            </option>
                        <?php endforeach; ?>
                        </option>
                    </select>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-light" id="insert">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal edit kategori -->
<?php foreach ($tbl_kategori as $value) : ?>
    <div class="modal fade" id="edit<?= $value['id_kategori'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open(base_url('kategori/edit/' . (int)$value['id_kategori'] . '')) ?>
                    <div class="form-group">
                        <label for="kategori">Kategori

                        </label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $value['nama_kategori'] ?>" placeholder="Nama kategori disini.." maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Sub Kategori
                        </label>
                        . <select class="custom-select form-control-border" id="kategori_sub_e" name="kategori_sub_e" style="width: 100%;">
                            <option>Sub Kategori</option>
                            <?php foreach ($subKategori as $val) : ?>

                                <?php $kate = $value['id_kategori_sub'] == $val['id']  ? 'selected="selected"' : "";  ?>

                                <option <?= $kate ?> value="<?= $val['id'] ?>" id_kat_sub="<?= $val['id'] ?>">
                                    <?= $val['id'] ?> |
                                    <?= $val['nama_kategori_sub'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
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
    /* -------------------  add ------------------------*/
    $(document).ready(function() {
        $(document).on("click", "#insert", function(e) {
            e.preventDefault();

            let nama_kategori = $("#nama_kategori").val();

            let id_kat_sub = $("option:selected", "#kategori_sub").attr("id_kat_sub");

            Swal.fire({
                title: "Pengajuan kategori" + " " + id_kat_sub,
                text: "anda mengajukan kategori " + id_kat_sub + " " +
                    " ,Klik ok untuk segera diproses.",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ok",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('kategori/add'); ?>",
                        data: {
                            nama_kategori: nama_kategori,
                            id_kat_sub: id_kat_sub,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error) {
                                // lokasi tidak ditemukan
                                if (data.error.nama_kategori.nama_kategori) {
                                    $(document).Toasts('create', {
                                        class: 'bg-maroon',
                                        title: 'Gagal!',
                                        subtitle: '',
                                        body: data.error.nama_kategori
                                            .nama_kategori
                                    })
                                }
                            } else {
                                if (data.response == "success") {
                                    Swal.fire(
                                        "Success",
                                        "Berhasil mengajukan " + nama_kategori,
                                        "success"
                                    );
                                }
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                                thrownError);
                        }
                    });
                }
            });
        });
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
                    url: "<?= base_url('kategori/delete'); ?>",
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