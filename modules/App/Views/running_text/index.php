<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Klasifikasi Jalan
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-klasifikasi-jalan']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Klasifikasi Jalan</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('klasifikasi_nama')) ? 'is-invalid' : ''; ?> klasifikasi_nama"
                               placeholder="Klasifikasi Jalan" name="klasifikasi_nama"
                               value="<?= old('klasifikasi_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('klasifikasi_nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi Inisial</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('klasifikasi_inisial')) ? 'is-invalid' : ''; ?> klasifikasi_inisial"
                               placeholder="Klasifikasi Inisial" name="klasifikasi_inisial"
                               value="<?= old('klasifikasi_inisial'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('klasifikasi_nama'); ?>
                        </div>
                    </div>
                    <input type="hidden" class="form-control klasifikasi_id" name="klasifikasi_id">
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
                    <h3 class="card-title">Data Klasifikasi Jalan</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Klasifikasi</th>
                                <th width="10%">Inisial</th>
                                <th width="10%"><i class="fa fa-refresh"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getKlasifikasiJalan as $i => $row) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1; ?></td>
                                    <td><?= $row['klasifikasi_nama']; ?></td>
                                    <td class="text-center"><?= $row['klasifikasi_inisial']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $attr = "data-id='{$row['klasifikasi_id']}' data-nama='{$row['klasifikasi_nama']}' data-inisial='{$row['klasifikasi_inisial']}'";
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
        $('.klasifikasi_inisial').val($(this).data('inisial'));
        $('.klasifikasi_nama').val($(this).data('nama'));
        $('.klasifikasi_id').val($(this).data('id'));
    })

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Klasifikasi Jalan : ' + nama,
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