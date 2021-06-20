<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Running Text
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-running-text']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Running Text</label>
                        <textarea class="form-control <?= ($validation->hasError('run_ket')) ? 'is-invalid' : ''; ?> run_ket"
                               placeholder="Text" name="run_ket"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('run_ket'); ?>
                        </div>
                    </div>
                    <input type="hidden" class="form-control run_id" name="run_id">
                    <input type="hidden" class="form-control status_aktif" name="status_aktif">
                    <?= getCsrf(); ?>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.reload()"><i class="fa fa-power-off"></i> Reset</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Running Text</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Running Text</th>
                                <th width="15%">Status</th>
                                <th width="10%"><i class="fa fa-refresh"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getRunningText as $i => $row) {
                                $status = $row['status_aktif'] == 1 ? 'disabled' : '';
                                ?>
                                <tr>
                                <td class="text-center"><?=$i+1;?></td>
                                <td ><?=$row['run_ket'];?></td>
                                <td class="text-center">
                                    <?php
                                    echo $row['status_aktif'] == 1 ? "<button {$status} class='btn btn-success btn-xs btn-block'><i class='fa fa-unlock'></i> Aktif</button>" : "<button data-id='{$row['run_id']}' class='btn btn-danger btn-xs btn-block btn-update-status'><i class='fa fa-lock'></i>Tidak Aktif</button>";
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $attrAction = "data-id='{$row['run_id']}' data-status='{$row['status_aktif']}' data-nama='{$row['run_ket']}'";
                                    echo btnAction('update', $attrAction, '',' btn-xs btn-update');
                                    echo btnAction('delete', $attrAction.' '.$status, '',' btn-xs btn-delete');
                                    ?>
                                </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script>
    $('.btn-update').click(function () {
        $('.run_id').val($(this).data('id'));
        $('.run_ket').text($(this).data('nama'));
        $('.status_aktif').val($(this).data('status'));
    })

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Running Text : ' + nama,
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
                    url: "<?= site_url($moduleUrl . '/delete_data'); ?>",
                    dataType: 'json',
                    data: {id: id},
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
    $('.btn-update-status').click(function () {
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin Update Status Running Text ',
            text: "Silahkan Klik Tombol Update Untuk Malnjutkan Aksi",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Update ',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "<?= site_url($moduleUrl . '/update_status'); ?>",
                    dataType: 'json',
                    data: {id},
                    success: (res) => {
                        notifSmartAlert(res.status, res.ket)
                    },
                    error: function (request, status, error) {
                        notifSmartAlert(false, request.responseText);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons('Cancel', 'Tidak ada aksi','error')
            }
        })
    })
</script>