<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Kabupaten
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-desa']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Kabupaten</label>
                        <input type="text" class="form-control kab_kode" name="kab_kode">
                    </div>
                    <div class="form-group">
                        <label>Nama Kabupaten</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('kab_nama')) ? 'is-invalid' : ''; ?> kab_nama"
                               placeholder="Nama Kabupaten" name="kab_nama"
                               value="<?= old('kab_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kab_nama'); ?>
                        </div>
                    </div>
                    <input type="hidden" name="prov_kode" value="63">
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
                    <h3 class="card-title">Data Kabupaten</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Kabupaten</th>
                                    <th width="15%">Kode Kabupaten</th>
                                    <th width="10%"><i class="fa fa-refresh"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($getKabupaten as $i => $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1; ?></td>
                                        <td><?= $row['kab_nama']; ?></td>
                                        <td class="text-center"><?= $row['kab_kode']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            $attr = "data-kab_kode='{$row['kab_kode']}' data-nama='{$row['kab_nama']}'";
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
        $('.kab_kode').val($(this).data('kab_kode'));
        $('.kab_nama').val($(this).data('nama'));
    });

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const kab_kode = $(this).data('kab_kode')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Kabupaten : ' + nama,
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
                    data: {kab_kode : kab_kode},
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