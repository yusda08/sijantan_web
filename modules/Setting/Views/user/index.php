<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <form method="get">
                    <div class="card-body">
                        <label>Pilih Level User</label>
                        <select class="select2" style="width: 100%" name="level" onchange='this.form.submit();'>
                            <option disabled selected value="">.: Level User :.</option>
                            <?php
                            foreach ($getUserLevel as $lvl) {
                                $attrSel = $lvl['kd_level'] == $kd_level ? 'selected' : '';
                                echo "<option $attrSel value='{$lvl['kd_level']}'>{$lvl['ket_level']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <?php
            if ($kd_level) { ?>
                <div class="card card-outline">
                    <div class="card-header ">
                        Form Input User
                    </div>
                    <form role="form" class="form-input-user" method="POST"
                          action="<?= site_url($moduleUrl . '/insert_user'); ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text"
                                       class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?> username"
                                       placeholder="Username" name="username" value="<?= old('username'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                            <div class="form-group text-password">
                                <label>Password</label>
                                <input type="password"
                                       class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?> password"
                                       name="password" placeholder="Password">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama User</label>
                                <input type="text" <?= $kd_level == 2 ? 'readonly' : ''; ?>
                                       class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : ''; ?> nama_user"
                                       placeholder="Nama User" name="nama_user" value="<?= old('nama_user'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_user'); ?>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="kd_level" value="<?= $kd_level; ?>">
                            <input type="hidden" class="form-control kode_group" name="kode_group">
                            <?= getCsrf(); ?>
                        </div>
                        <div class="card-footer center">
                            <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger" onclick="window.location.reload()">Reset
                            </button>
                        </div>
                    </form>
                </div>
                <?php
            } ?>

        </div>
        <div class="col-md-8">
            <!-- DIRECT CHAT -->
            <?php
            if ($kd_level) { ?>
            <div class="card card-outline">
                <div class="card-header bg-gray">
                    <h3 class="card-title">Data User</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Username</th>
                            <th>Nama User</th>
                            <th width="8%">Status</th>
                            <th width="15%">Reset</th>
                            <th width="8%"><i class="fa fa-refresh"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($getUser as $row) {
                            if ($kd_level == $row['kd_level']) {
                                $att = $row['kd_user'] == 1 ? 'disabled' : '';
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['nama_user']; ?></td>
                                    <td class="text-center">
                                        <input <?= $row['is_active'] == 1 ? "checked='checked'" : ''; ?>
                                            <?= $att; ?> class="form-check btn-isactive" type="checkbox"
                                                         data-kd_user="<?= $row['kd_user']; ?>"
                                                         data-is_active="<?= $row['is_active'] ?>"
                                                         name="checkbox-toggle">
                                    </td>
                                    <td class="text-center">
                                        <button <?= $att; ?> data-kd_user="<?= $row['kd_user']; ?>"
                                                             class="btn btn-warning btn-xs btn-flat btn-reset-pass"><i
                                                    class="fa fa-pencil-alt"></i> Reset Pass
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button <?= $att; ?>
                                                data-kd_user="<?= $row['kd_user']; ?>"
                                                data-nama_user="<?= $row['nama_user']; ?>"
                                                class="btn btn-danger btn-xs btn-flat btn-delete"><i
                                                    class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    } else {
        statusWarning(' Pilih Level User', 'Pilih Terlebih Dahulu Level User untuk melakukan Aksi !!!');
    } ?>
</div>
<?= $this->include('backend/javasc'); ?>
<script>
    $('.select-skpd').change(function () {
        $('.nama_user').val($(this).find('option:selected').data('nama_user'));
        $('.kode_group').val($(this).val());
    })


    $('.btn-isactive').click(function () {
        const kd_user = $(this).data('kd_user');
        const is_active = $(this).data('is_active');
        $.ajax({
            type: 'POST',
            url: '<?= site_url($moduleUrl . '/is_active'); ?>',
            dataType: 'json',
            data: {
                kd_user: kd_user,
                is_active: is_active
            },
            success: (res) => {
                notifSmartAlert(res.status, res.ket);
            },
        });
    })
    $('.btn-reset-pass').click(function () {
        const kd_user = $(this).data('kd_user')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin Reset Password User dengan Password Default : 123456',
            text: "Silahkan Klik Tombol Reser Untuk melakukan Aksi",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Reset ',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url($moduleUrl . '/reset_password'); ?>",
                    dataType: 'json',
                    data: {kd_user: kd_user},
                    success: (res) => {
                        notifSmartAlert(res.status, res.ket)
                    },
                    error: (request, status, error) => {
                        notifSmartAlert(false, request.responseText);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons(
                    'Cancel',
                    'Tidak ada aksi hapus data',
                    'error'
                )
            }
        })
    })

    $(document).ready(function () {
        callBackClassAfter('.username', 'cek-username');
        $('.username').change(function () {
            const username = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?= base_url($moduleUrl . '/get_username'); ?>',
                data: {username: username},
                success: (result) => {
                    if (result == null) {
                        $('.btn-save').prop('disabled', false);
                        $('.cek-username').html('<img src="<?= base_url('assets/img/true.png'); ?>"><b style="color:green;"> Username Valid</b>');
                    } else {
                        $('.btn-save').prop('disabled', true);
                        $('.cek-username').html('<img src="<?= base_url('assets/img/false.png'); ?>"><b style="color:red;"> Username Double</b>');
                    }
                }
            });
        });
    });

    $('.btn-delete').click(function () {
        const nama_user = $(this).data('nama_user')
        const kd_user = $(this).data('kd_user')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus User dangen Nama : ' + nama_user,
            text: "Silahkan Klik Tombol Delete Untuk Menghapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete ',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url($moduleUrl . '/delete_user'); ?>",
                    dataType: 'json',
                    data: {kd_user: kd_user},
                    success: (res) => {
                        notifSmartAlert(res.status, res.ket)
                    },
                    error: function (request, status, error) {
                        notifSmartAlert(false, request.responseText);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons(
                    'Cancel',
                    'Tidak ada aksi hapus data',
                    'error'
                )
            }
        })
    })
</script>