<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Tipe Kondisi Jalan
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-tipekondisi-jalan']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Tipe Kondisi Jalan</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('tipekondisi_nama')) ? 'is-invalid' : ''; ?> tipekondisi_nama"
                               placeholder="Tipe Kondisi Jalan" name="tipekondisi_nama"
                               value="<?= old('tipekondisi_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tipekondisi_nama'); ?>
                        </div>
                    </div>
                    <input type="hidden" class="form-control tipekondisi_id" name="tipekondisi_id">
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
                    <h3 class="card-title">Data Tipe Kondisi Jalan</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Tipe Kondisi</th>
                                <th width="10%"><i class="fa fa-refresh"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getTipeKondisi as $i => $row) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1; ?></td>
                                    <td><?= $row['tipekondisi_nama']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $attr = "data-id='{$row['tipekondisi_id']}' data-nama='{$row['tipekondisi_nama']}' ";
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
        $('.tipekondisi_nama').val($(this).data('nama'));
        $('.tipekondisi_id').val($(this).data('id'));
    })

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Tipe Kondisi Jalan : ' + nama,
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