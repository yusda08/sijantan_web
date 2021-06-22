<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Pengaduan Jalan</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group ">
                        <li class="list-group-item bg-info" style="font-size: 14pt">Kode Tiket
                            : <?= $row_tiket['tiket_kode']; ?></li>
                    </ul>
                    <hr>
                    <div class="row">
                        <label class="col-md-4 col-5">Ruas Jalan</label>
                        <div class="col-md-8 text-justify"><?= $row_tiket['ruas_nama']; ?></div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4 col-7">Tanggal</label>
                        <div class="col-md-8 text-justify"><?= tgl_indo($row_tiket['pengadu_tgl']); ?></div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4 col-7">Isi Pengaduan</label>
                        <div class="col-md-8 text-justify"><?= $row_tiket['pengadu_ket']; ?></div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4 col-7">Nama Pengadu</label>
                        <div class="col-md-8 text-justify"><?= $row_tiket['pengadu_nama']; ?></div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4 col-7">No Telpon</label>
                        <div class="col-md-8 text-justify"><?= $row_tiket['pengadu_no_hp']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Respon Pengaduan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <?= form_open(site_url($moduleUrl . '/add_data'), ['class' => 'form-respon']); ?>
                            <div class="row form-group justify-content-between">
                                <div class="col-md-4 col-6">
                                    <button class="btn btn-primary btn-block btn-tambah" type="button"><i
                                                class="fa fa-plus"></i> Respon
                                    </button>
                                </div>
                                <div class="col-md-4 col-6">
                                    <button class="btn btn-success btn-block btn-save"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12">
                                    <label>Keterangan</label>
                                    <textarea class="form-control keterangan" rows="3" name="keterangan[]"
                                              placeholder="Keterangan" required></textarea>
                                </div>
                            </div>
                            <div class="addKeterangan"></div>
                            <?= getCsrf(); ?>
                            <input type="hidden" class="form-control tiket" name="tiket" value="<?= $tiket; ?>">
                            <?= form_close(); ?>
                        </div>
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Isi</th>
                                        <th>Tanggal</th>
                                        <th width="5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($getRespon as $i => $row_respon) {
                                        $count = count($getRespon);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1; ?></td>
                                            <td><?= $row_respon['respon_ket']; ?></td>
                                            <td class="text-center"><?= tgl_indo($row_respon['respon_tgl']); ?></td>
                                            <td class="text-center">
                                                <?php
                                                $attr = "data-id='{$row_respon['respon_id']}' 
                                                            data-isi='{$row_respon['respon_ket']}'
                                                            data-count='{$count}'
                                                            data-tiket='{$tiket}'";
                                                echo btnAction('delete', $attr, '', 'btn-delete btn-xs')
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
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script>
    $('.btn-tambah').on('click', function (e) {
        e.preventDefault();
        var htmls = `<div class="row form-group element-keterangan">
                        <div class="col-11"><textarea class="form-control keterangan" rows="3" name="keterangan[]" placeholder="Keterangan" required></textarea></div>
                        <div class="col-1"><button class="btn btn-danger btn-flat btn-xs btn-hapus" type="button"><i class="fa fa-trash"></i></button></div>
                     </div>`;
        $('.addKeterangan').append(htmls);
    });
    $(".addKeterangan").on('click', '.btn-hapus', function () {
        $(this).closest('.element-keterangan').remove();
    });

    $('.form-respon').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
            beforeSend: () => {
                $('.btn-save').html(`<i class="fa fa-spin fa-spinner"></i> Loading . . .`)
                $('.btn-save').prop('disabled', true)
            },
            complete: () => {
                $('.btn-save').html(`<i class="fa fa-save"></i>  &nbsp; Simpan`)
                $('.btn-save').prop('disabled', false)
            },
            success: (res) => {
                notifSmartAlert(res.status, res.ket)
            },
            error: function (request, status, error) {
                notifSmartAlert(false, request.responseText);
            }
        })
        return false;
    })

    $('.btn-delete').click(function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        const isi = $(this).data('isi')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Respon : ' + isi,
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
                    data: {id},
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