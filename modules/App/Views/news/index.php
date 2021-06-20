<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header"> Form Berita</div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-berita']) ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3">Judul Berita</label>
                        <div class="col-md-9">
                            <input class="form-control <?= ($validation->hasError('news_judul')) ? 'is-invalid' : ''; ?> news_judul"
                                   placeholder="Judul Berita" name="news_judul">
                            <div class="invalid-feedback">
                                <?= $validation->getError('news_judul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Isi Berita</label>
                        <div class="col-md-9">
                        <textarea
                                class="form-control <?= ($validation->hasError('news_ket')) ? 'is-invalid' : ''; ?> news_ket"
                                placeholder="Isi Berita" name="news_ket"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('news_ket'); ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control news_id" name="news_id">
                    <?= getCsrf(); ?>
                </div>
                <div class="card-footer row justify-content-end">
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline">
                <div class="card-header">
                    Data Berita
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered tabel_3" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th width="8%"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getNews as $i => $row) { ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1; ?></td>
                                    <td><?= $row['news_judul']; ?></td>
                                    <td><?= $row['news_ket']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $attr = "data-id='{$row['news_id']}' data-judul='{$row['news_judul']}' data-ket='{$row['news_ket']}'";
                                        echo btnAction('update', $attr, '', 'btn-xs btn-update');
                                        echo btnAction('delete', $attr, '', 'btn-xs btn-delete');
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
        $('.news_id').val($(this).data('id'));
        $('.news_ket').text($(this).data('ket'));
        $('.news_judul').val($(this).data('judul'));
    })

    $('.btn-delete').click(function () {
        const judul = $(this).data('judul')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Berita dengan Judul : ' + judul,
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
                   url: siteUrl('<?=$moduleUrl;?>/delete_data'),
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
                swalWithBootstrapButtons('Cancel', 'Tidak ada aksi hapus data', 'error'
                )
            }
        })
    })
</script>