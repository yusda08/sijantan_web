<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Permukaan Jalan
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-permukaan-jalan']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Permukaan Jalan</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('permukaan_nama')) ? 'is-invalid' : ''; ?> permukaan_nama"
                               placeholder="Nama Permukaan Jalan" name="permukaan_nama"
                               value="<?= old('permukaan_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('permukaan_nama'); ?>
                        </div>
                    </div>
                    <input type="hidden" class="form-control permukaan_id" name="permukaan_id">
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
                    <h3 class="card-title">Data Permukaan Jalan</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Permukaan</th>
                                <th width="8%"><i class="fa fa-refresh"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getPermukaanJalan as $i => $row) {
                                ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= $row['permukaan_nama']; ?></td>
                                    <td>
                                        <?php
                                        $attr = "data-id='{$row['permukaan_id']}' data-nama='{$row['permukaan_nama']}'";
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
        $('.permukaan_nama').val($(this).data('nama'));
        $('.permukaan_id').val($(this).data('id'));
    })

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Permukaan Jalan : ' + nama,
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