<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Kondisi Jalan
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-kondisi-jalan']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kondisi Jalan</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('kondisi_nama')) ? 'is-invalid' : ''; ?> kondisi_nama"
                               placeholder="Kondisi Jalan" name="kondisi_nama"
                               value="<?= old('kondisi_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kondisi_nama'); ?>
                        </div>
                    </div>
                    <input type="hidden" class="form-control kondisi_id" name="kondisi_id">
                    <?= getCsrf(); ?>
                </div>
                <div class="card-footer center">
                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.reload()">Reset</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Kondisi Jalan</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kondisi</th>
                            <th width="8%"><i class="fa fa-refresh"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($getKondisiJalan as $i => $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $i + 1; ?></td>
                                <td><?= $row['kondisi_nama']; ?></td>
                                <td>
                                    <?php
                                    $attr = "data-id='{$row['kondisi_id']}' data-nama='{$row['kondisi_nama']}'";
                                    echo btnAction('update', $attr, '', 'btn-update');

                                    echo btnAction('delete', $attr, '', 'btn-delete');
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
        $('.kondisi_nama').val($(this).data('nama'));
        $('.kondisi_id').val($(this).data('id'));
    })

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Kondisi Jalan : ' + nama,
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
</script>