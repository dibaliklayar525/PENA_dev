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
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><?= $title ?></h3>
                        </div>

                        <div class="card-body">
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
                                echo $output =
                                    '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    ' . session()->getFlashdata('pesan') . '
                                    </div>
                                    ';
                            }
                            ?>

                            <?= form_open_multipart('user/insert') ?>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nama">nama</label>
                                        <input type="text" class="form-control" id="nama_user" name="nama_user"
                                            placeholder="Nama.." maxlength="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">email</label>
                                        <input type="text" autocomplete="off" class="form-control" id="email"
                                            name="email" placeholder="email.." maxlength="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">password</label>
                                        <input type="password" autocomplete="off" class="form-control" id="password"
                                            name="password" placeholder="password..">
                                    </div>
                                    <div class="form-group">
                                        <label for="ulangi password">ulangi password</label>
                                        <input type="password" class="form-control" id="retype_password"
                                            name="retype_password" placeholder="ulangi password..">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select class="form-control" name="level" style="width: 100%;">
                                            <option>pilih level</option>
                                            <?php foreach ($level as $value) : ?>
                                            <option value="<?= $value['id_level'] ?>"><?= $value['level_name'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>departemen</label>
                                        <select class="form-control select2" name="id_dep" id="id_dep"
                                            style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Departemen</label>
                                        <select class="form-control select2" name="id_sub" id="id_sub"
                                            style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                                <label class="custom-file-label" for="avatar">Pilih avatar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                        <?= form_close() ?>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>

<script>
// function load_ajax() {
//     let xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             document.querySelector("select[name=id_dep]").innerHTML = xhr.responseText;
//         }
//     }
//     xhr.open('POST', '<?= base_url('get_dep'); ?>', true);
//     xhr.send();

//     let input = document.querySelector('option:selected', this).attr('id_dep');

// }
$(document).ready(function() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?= base_url('get_dep'); ?>",
        success: function(data) {
            $("select[name=id_dep]").html(data);
        }
    });

    $("#id_dep").change(function() {
        let id = $("option:selected", this).attr("id_dep");
        $.ajax({
            type: "POST",
            url: "<?= base_url('sub_dep_byId'); ?>",
            data: {
                idd: id
            },
            dataType: "json",
            success: function(response) {
                $("select[id=id_sub]").html(response);
            },
            error: function(response) {
                alert("error 500");
            }
        });
    });
});
</script>

<!-- /.content-wrapper -->
<?= $this->endSection(); ?>