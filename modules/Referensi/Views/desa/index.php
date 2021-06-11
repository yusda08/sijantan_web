<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    Form Desa
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-desa']) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Desa</label>
                        <input type="text" class="form-control desa_kode" name="desa_kode">
                    </div>
                    <div class="form-group">
                        <label>Nama Desa</label>
                        <input type="text"
                               class="form-control <?= ($validation->hasError('desa_nama')) ? 'is-invalid' : ''; ?> desa_nama"
                               placeholder="Nama Desa" name="desa_nama"
                               value="<?= old('desa_nama'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('desa_nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kode Kabupaten</label>
                        <select class="select2 loadKabupaten kab_kode" name="kab_kode" style="width: 100%" required>
                            <option value="">.: Pilih Kabupaten :.</option>
                            <?php
                            foreach ($getKabupaten as $row) {
                                echo "<option value='$row->kab_kode'>$row->kab_nama</option>";
//                                echo "<option value='" . $row['kab_kode'] . "'>" . $row['kab_nama'] . " (" . $row['kab_kode'] . ") </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Kecamatan</label>
                        <select class="select2 kec_kode loadKecamatan" name="kec_kode" style="width: 100%" required>
                            <option value="">.: Pilih Kecamatan :.</option>
                        </select>
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
                    <h3 class="card-title">Data Desa</h3>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Desa</th>
                                    <th width="15%">Kode Desa</th>
                                    <th width="10%"><i class="fa fa-refresh"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($getDesa as $i => $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1; ?></td>
                                        <td><?= $row['desa_nama']; ?></td>
                                        <td class="text-center"><?= $row['desa_kode']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            $attr = "data-desa_kode='{$row['desa_kode']}' data-nama='{$row['desa_nama']}' data-kec_kode='{$row['kec_kode']}' data-kab_kode='{$row['kab_kode']}'";
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
    let kab_kode, kec_kode;
    $('.btn-update').click(function () {
        kab_kode = $(this).data('kab_kode');
        kec_kode = $(this).data('kec_kode');
        $('.desa_kode').val($(this).data('desa_kode'));
        $('.desa_nama').val($(this).data('nama'));
        $('.kab_kode').val(kab_kode).change();
    });
    $(".loadKabupaten").change(function () {
        const kab_kode = $(this).find('option:selected').val();
        $.ajax({
            type: 'GET',
            url: '<?= site_url('referensi/desa/load_kecamatan'); ?>',
            data: {kab_kode},
            success: function (data) {
                $('.loadKecamatan').html(data);
                $('.kec_kode').val(kec_kode).change();
            }
        });
    });

    $('.btn-delete').click(function () {
        const nama = $(this).data('nama')
        const desa_kode = $(this).data('desa_kode')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Desa : ' + nama,
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
                    data: {desa_kode : desa_kode},
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