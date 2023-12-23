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
                                    data-toggle="modal" data-target="#TambahArsip"><i class="fa fa-plus"></i> tambah
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- filtering -->
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" id="kategori" name="kategori" style="width: 100%;">
                                            <option>Pilih kategori</option>
                                            <?php foreach ($kategori as $value) : ?>
                                            <option value="<?= $value['id_kategori'] ?>"
                                                idd="<?= $value['id_kategori'] ?>">
                                                <?= $value['nama_kategori'] ?> | <?= $value['nama_kategori_sub'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" id="tahunArsip" name="tahunArsip"
                                            style="width: 100%;">
                                            <option value="">Pilih tahun</option>
                                            <?php foreach ($tahun as $value) : ?>
                                            <option value="<?= $value->tahun ?>"><?= $value->tahun ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- table -->
                            <table id="tbl_arsip" class="table table-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Tgl Upload</th>
                                        <th>Tgl Surat</th>
                                        <th>Tahun</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>

</div>

<!-- Modal add  -->
<div class="modal fade" id="TambahArsip">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="reset">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_user">User<sup class="text-red">*</sup></label>
                                <input type="hidden" class="form-control" id="id_user" name="id_user"
                                    value="<?php echo session()->get('id_user'); ?>" readonly>
                                <div class="invalid-feedback error_id_user">

                                </div>
                                <input type="text" class="form-control" id="nama_user" name="nama_user"
                                    value="<?php echo session()->get('nama_user'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Sub - Departemen<sup class="text-red">*</sup></label>
                                <input type="hidden" class="form-control" id="id_sub_dep" name="id_sub_dep"
                                    value="<?php echo session()->get('id_sub_dep'); ?>" readonly>
                                <div class="invalid-feedback error_id_sub_dep">

                                </div>
                                <input type="text" class="form-control" id="nama_sub_dep" name="nama_sub_dep"
                                    value="<?php echo session()->get('nama_sub_dep'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Departemen<sup class="text-red">*</sup></label>
                                <input type="hidden" class="form-control" id="id_dep" name="id_dep"
                                    value="<?php echo session()->get('id_dep'); ?>" readonly>
                                <div class="invalid-feedback error_id_dep">

                                </div>
                                <input type="text" class="form-control" id="nama_dep" name="nama_dep"
                                    value="<?php echo session()->get('nama_dep'); ?>" readonly>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Kategori<sup class="text-red">*</sup></label>
                                <select class="form-control" id="level" name="level" style="width: 100%;">
                                    <option>Pilih kategori</option>
                                    <?php foreach ($kategori as $value) : ?>
                                    <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?> |
                                        <?= $value['nama_kategori_sub'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback error_level">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Nomor Surat<sup class="text-red">*</sup></label>
                                <input type="text" class="form-control" id="no_arsip" name="no_arsip"
                                    placeholder="17/Prov/2023" maxlength="255" aria-describedby="error_no_arsip">
                                <div id="error_no_arsip" class="invalid-feedback error_no_arsip">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_surat">Tanggal Surat<sup class="text-red">*</sup></label>
                                <input type="text" class="form-control" name="tgl_surat" id="tgl_surat" readonly>
                                <div id="error_tgl_surat" class="invalid-feedback error_tgl_surat">

                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_file">Nama<sup class="text-red">*</sup></label>
                                <input type="text" class="form-control" id="nama_file" name="nama_file"
                                    aria-describedby="error_nama_file" required>
                                <div id="error_nama_file" class="invalid-feedback error_nama_file">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun<sup class="text-red">*</sup></label>
                                <input type="text" class="form-control" id="tahun" name="tahun" maxlength="4"
                                    placeholder="<?= date('Y') ?>">
                                <div id="error_tahun" class="invalid-feedback error_tahun">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_arsip">Unggah File</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_arsip" name="file_arsip"
                                            accept="application/pdf,image/png, image/jpg, image/jpeg">
                                        <label class="custom-file-label add-file-label" for="file_arsip">pilih
                                            pdf/jpg/png</label>
                                    </div>
                                    <div id="error_file_arsip" class="invalid-feedback error_file_arsip">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                            placeholder="Deskripsikan isi surat ..."></textarea>
                        <div class="invalid-feedback error_deskripsi">

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-primary add" id="add" disable>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // table
    let tableUmum;
    tableUmum = $('#tbl_arsip').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "lengthChange": true,
        "ordering": true,
        "searching": true,
        "autoWidth": false,
        "info": true,
        "order": [],

        "ajax": {
            "url": "<?= base_url('arsip/serverSide'); ?>",
            "type": "POST",
            "data": function(data) {
                data.tahun = $("#tahunArsip").val();
                data.id_kategori = $("option:selected", "#kategori").attr("idd");
            }
        },

        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],

        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4, 5, 6, 7],
            "className": 'text-center',
        }],

        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        "bPaginate": true,
        "sPaginationType": "full_numbers",

        "dom": 'Blfrtip',
        "language": {
            "url": 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
        }
    });

    // filter
    function kategori() {
        $('#kategori').change(function() {
            tableUmum.draw();
        });
    }

    function tahun() {
        $('#tahunArsip').change(function() {
            tableUmum.draw();
        });
    }
    tahun();
    kategori();

    // date picker
    let today;
    today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#tgl_surat').datepicker({
        format: 'yyyy-mm-dd',
        maxDate: today,
    });

    // custom upload form
    $(".custom-file-input").on("change", function() {
        let fileName = $(this).val().split("\\").pop();
        let label = $(this).siblings(".custom-file-label");
        if (label.data("default-title") == undefined) {
            label.data("default-title", label.html());
        }
        if (fileName == "") {
            label.removeClass("selected").html(label.data("default-title"));
        } else {
            label.addClass("selected").html(fileName);
        }
    });
});

// add
$(document).on("click", "#add", function(e) {
    e.preventDefault();

    let id_user = $("#id_user").val();
    let id_dep = $("#id_dep").val();
    let id_sub_dep = $("#id_sub_dep").val();
    let level = $("#level").val();
    let tgl_surat = $("#tgl_surat").val();
    let no_arsip = $("#no_arsip").val();
    let nama_file = $("#nama_file").val();
    let tahun = $("#tahun").val();
    let deskripsi = $("#deskripsi").val();
    // image
    let file_arsip = $("#file_arsip")[0].files[0];

    let fd = new FormData();
    fd.append("id_user", id_user);
    fd.append("id_sub_dep", id_sub_dep);
    fd.append("id_dep", id_dep);
    fd.append("level", level);
    fd.append("tgl_surat", tgl_surat);
    fd.append("no_arsip", no_arsip);
    fd.append("nama_file", nama_file);
    fd.append("tahun", tahun);
    fd.append("deskripsi", deskripsi);
    fd.append("file_arsip", file_arsip);

    $.ajax({
        type: "post",
        url: "<?= base_url('arsip/add'); ?>",
        data: fd,
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function() {
            $('.add').attr('disable', 'disabled');
            $('.add').html('<i class="fa fa-spin fa-spinner text-center"></i>');
        },
        complete: function() {
            $('.add').removeAttr('disable');
            $('.add').html('coba lagi');

        },
        success: function(response) {
            if (response.error) {
                if (response.error.nama_file.nama_file) {
                    $('#nama_file').addClass('is-invalid');
                    // alert(JSON.stringify(response.error.nama_file))
                    $('#error_nama_file').html(response.error.nama_file.nama_file);
                } else {
                    $('#nama_file').removeClass('is-invalid');
                    $('#error_nama_file').html('');
                }
                if (response.error.no_arsip.no_arsip) {
                    $('#no_arsip').addClass('is-invalid');
                    $('.error_no_arsip').html(response.error.no_arsip.no_arsip);
                } else {
                    $('#no_arsip').removeClass('is-invalid');
                    $('.error_no_arsip').html('');
                }
                if (response.error.deskripsi.deskripsi) {
                    $('#deskripsi').addClass('is-invalid');
                    $('.error_deskripsi').html(response.error.deskripsi.deskripsi);
                } else {
                    $('#deskripsi').removeClass('is-invalid');
                    $('.error_no_arsip').html('');
                }
                // select
                if (response.error.level) {
                    $('#level').addClass('is-invalid');
                    $('.error_level').html(response.error.level.level);
                } else {
                    $('#level').removeClass('is-invalid');
                    $('.error_level').html('');
                }

                if (response.error.tgl_surat.tgl_surat) {
                    toastr["error"](response.error.tgl_surat.tgl_surat);
                    $('#tgl_surat').addClass('is-invalid');
                } else {
                    $('#tgl_surat').removeClass('is-invalid');
                    $('.error_tgl_surat').html('');
                }
                if (response.error.tahun.tahun) {
                    $('#tahun').addClass('is-invalid');
                    $('.error_tahun').html(response.error.tahun.tahun);
                } else {
                    $('#tahun').removeClass('is-invalid');
                    $('.error_tahun').html('');
                }
                if (response.error.id_user.id_user) {
                    $('#id_user').addClass('is-invalid');
                    toastr["error"](response.error.id_user.id_user);
                } else {
                    $('#id_user').removeClass('is-invalid');
                    $('.error_id_user').html('');
                }
                if (response.error.id_sub_dep.id_sub_dep) {
                    $('#id_sub_dep').addClass('is-invalid');
                    toastr["error"](response.error.id_sub_dep.id_sub_dep);
                } else {
                    $('#id_sub_dep').removeClass('is-invalid');
                    $('.error_id_sub_dep').html('');
                }
                if (response.error.id_dep.id_dep) {
                    $('#id_dep').addClass('is-invalid');
                    toastr["error"](response.error.id_dep.id_dep);
                } else {
                    $('#id_dep').removeClass('is-invalid');
                    $('.error_id_dep').html('');
                }
                if (response.error.file_arsip.file_arsip) {
                    toastr["error"](response.error.file_arsip.file_arsip);
                    $('#file_arsip').addClass('is-invalid');
                } else {
                    $('#file_arsip').removeClass('is-invalid');
                    $('.error_file_arsip').html('');

                }
            } else {

                // Sukses

                if (response.responsez == "success") {
                    toastr["success"](response.message);
                    $("#TambahArsip").modal("hide"); // tutup modal
                    $(".reset")[0].reset(); // dan reset form
                    $(".add-file-label").html("pilih pdf/jpg/png"); // reset input type file
                    $("#tbl_arsip").DataTable().ajax.reload(); // refresh data table
                    fetch(null);
                } else {
                    toastr["error"](response.message);
                }

            }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

});

//  Delete
$(document).on("click", "#btn-del", function(e) {
    e.preventDefault();
    let del_id = $(this).attr("deletedById");
    Swal.fire({
        title: "Yakin ingin menghapus data?",
        text: "Data yang dihapus tidak dapat dikembalikan lagi.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?= base_url('arsip/delete'); ?>",
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
                        $("#tbl_arsip").DataTable().ajax.reload(); // refresh data table
                        fetch(null);
                    }
                },
                error: function(data) {
                    errorAjax();
                }
            });
        }
    });
});

// edit
// $(document).on("click", "#edit", function(e) {
//     e.preventDefault();
//     let editByid = $(this).attr("editByid");
//     $.ajax({
//         url: "<?= base_url('edit'); ?>",
//         type: "post",
//         processData: false,
//         contentType: false,
//         dataType: "json",
//         data: {
//             editByid: editByid,
//         },
//     });
// });
</script>

<?= $this->endSection(); ?>