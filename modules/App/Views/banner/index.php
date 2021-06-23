<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header"> Form Banner</div>
                <?= form_open_multipart($moduleUrl . '/add_data', ['class' => 'form-banner']) ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4">Judul Banner</label>
                        <div class="col-md-8">
                            <input class="form-control banner_judul" placeholder="Judul Banner" name="banner_judul">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Isi Keterangan</label>
                        <div class="col-md-8">
                        <textarea rows="3"placeholder="Isi Banner" name="banner_ket" class="form-control banner_ket"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 col-form-label">File Foto</label>
                        <div class="col-md-8">
                            <div class="custom-file">
                                <input type="file" onchange="previewImg()" class="custom-file-input" id="file_foto"
                                       name="file" required>
                                <label class="custom-file-label" for="file_foto"></label>
                                <note>Note : File yang di Upload Format harus Foto</note>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="file-preview"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control banner_id" name="banner_id">
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
                    Data Banner
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered tabel_3" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th width="20%">Foto</th>
                                <th width="8%"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($getBanner as $i => $row) { ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1; ?></td>
                                    <td><?= $row['banner_judul']; ?></td>
                                    <td><?= $row['banner_ket']; ?></td>
                                    <td class="text-center"><img style="width: 100px; height: 50px" src="<?= base_url($row['foto_path'].'/'.$row['foto_name']) ; ?>" class="img-responsive"></td>
                                    <td class="text-center">
                                        <?php
                                        $attr = "data-id='{$row['banner_id']}' 
                                                 data-judul='{$row['banner_judul']}'
                                                 data-foto_path='{$row['foto_path']}'
                                                 data-foto_name='{$row['foto_name']}'";
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
    $('.btn-delete').click(function () {
        const judul = $(this).data('judul')
        const foto_name = $(this).data('foto_name')
        const foto_path = $(this).data('foto_path')
        const id = $(this).data('id')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Banner dengan Judul : ' + judul,
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
                   data: {id, foto_path, foto_name},
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

    function previewImg() {
        const file = document.querySelector('#file_foto');
        const label = document.querySelector('.custom-file-label');
        const filePreview = document.querySelector('.file-preview');
        label.textContent = file.files[0].name;
        const filePdf = new FileReader();
        filePdf.readAsDataURL(file.files[0]);

        filePdf.onload = function (e) {
            console.log(e.target.result)
            filePreview.innerHTML = `<img src="${e.target.result}" class="img-responsive" width="300" height="200">`;
        };
    }

</script>