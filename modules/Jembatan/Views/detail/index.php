<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Jembatan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger active" href="<?= site_url('jembatan/input_data'); ?>"><i
                                        class="fa fa-backward"></i> Kembali</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $attrAdd = "";
                    echo btnAction('update', $attrAdd, 'Edit', '');
                    echo btnAction('delete', $attrAdd, 'Hapus', '');
                    ?>

                    <ul class="list-group">
                        <li class="list-group-item"><?= sprintfNumber($row_jembatan['nomor'], 3) . '. ' . $row_jembatan['nama']; ?></li>
                        <li class="list-group-item">Kecamatan : <?= $row_jembatan['kecamatan']; ?></li>
                        <li class="list-group-item">Nama Ruas : <?= $row_jembatan['ruas']; ?></li>
                        <li class="list-group-item">STA : <?= $row_jembatan['sta']; ?></li>
                        <li class="list-group-item">Panjang : <?= $rowSpesifikasiJembatan['panjang']; ?> Meter</li>
                        <li class="list-group-item">Lebar : <?= $rowSpesifikasiJembatan['lebar']; ?> Meter</li>
                        <li class="list-group-item">Jumlah Bentang : <?= $rowSpesifikasiJembatan['jumlah_bentang']; ?></li>
                        <li class="list-group-item">Kondisi Lantai Bangunan : <?= $rowSpesifikasiJembatan['kondisi_nama']; ?></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="card card-outline">
                <div class="card-body p-0">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tipe dan Kondisi Jembatan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <?php
                                $attrAdd = "data-jembatan_id='{$row_jembatan['jembatan_id']}'";
                                echo btnAction('add', $attrAdd, '', ' btn-add-kondisi');
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipe</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($getTipeKondisiJembatan as $row_kondisi) {
                                ?>
                                <tr>
                                    <td><?= $row_kondisi->tipekondisi_nama; ?></td>
                                    <td class="text-center"><?= $row_kondisi->tipe; ?></td>
                                    <td class="text-center"><?= $row_kondisi->kondisi_nama; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Asset Jembatan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <?php
                                $attrAset = "data-jembatan_id='{$row_jembatan['jembatan_id']}'";
                                echo btnAction('add', $attrAset, ' Asset', ' btn-asset');
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($getAssetJembatan as $row_asset) { ?>
                            <div class="col-md-4">
                                <div class="card well_avarage">
                                    <a href="<?= base_url($row_asset['foto_path'] . $row_asset['foto_name']); ?>">

                                        <img src="<?= base_url($row_asset['foto_path'] . $row_asset['foto_name']); ?>"
                                             style="width: 100%; height: 200px" class="img-responsive">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row_asset['foto_judul']; ?></h5>
                                        <br>
                                        <?php
                                        $attrDeleteAsset = "data-id='{$row_asset['id']}' data-judul='{$row_asset['foto_judul']}'
                                        data-foto_path='{$row_asset['foto_path']}'
                                        data-foto_name='{$row_asset['foto_name']}'";

                                        echo btnAction('delete', $attrDeleteAsset, '', ' btn-sm btn-delete-asset')
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-asset" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open_multipart($moduleUrl . '/upload_foto', ['class' => 'form-asset']); ?>
            <div class="modal-header">
                <h5 class="modal-title label_head"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Asset</label>
                    <input type="text" class="form-control foto_judul" name="foto_judul" required>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 col-form-label">File Foto</label>
                    <div class="col-md-9">
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
                <input type="hidden" class="form-control jembatan_id" name="jembatan_id">
                <?= getCsrf(); ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<?= $this->include('backend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfbNIQF80jqSlMYpwmV4pKt00r6Wz6xyc&callback=initMap&libraries=&v=weekly"
async></script>
<script>
    $('.btn-add-kondisi').click(function () {
        const jembatan_id = $(this).data('jembatan_id');
        const ruas_panjang = $(this).data('ruas_panjang');
        const thisTag = $('#modal-add-kondisi')
        thisTag.modal('show')
        thisTag.find('.modal-title').text('Form Input Kondisi');
        thisTag.find('.modal-body input.jembatan_id').val(jembatan_id);
        thisTag.find('.modal-body input.ruas_panjang').val(ruas_panjang);
    });

    $('body').addClass('sidebar-collapse');
    let map;

    async function initMap() {
        let lat = parseFloat(<?= $row_jembatan['latitude'] ?>);
        let lng = parseFloat(<?= $row_jembatan['longitude'] ?>);
        const myLatLng = {lat: lat, lng: lng};

        const mapOptions = {
            zoom: 13,
            mapTypeControl: true,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            disableDefaultUI: true,
            overviewMapControl: true,
            streetViewControl: true
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        let marker = new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Lokasi Jembatan",
        });

    }
    
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
    
    $('.btn-asset').click(function () {
        const thisTag = $('#modal-add-asset')
        thisTag.modal('show')
        thisTag.find('.modal-title').text(`Form Input Asset`);
        thisTag.find('.modal-body input.jembatan_id').val($(this).data('jembatan_id'));
    });
    
    $('.btn-delete-asset').click(function () {
        const id = $(this).data('id');
        const foto_name = $(this).data('foto_name');
        const foto_path = $(this).data('foto_path');
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Foto : ' + $(this).data('judul'),
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
                    url: "<?= site_url($moduleUrl . '/delete_foto'); ?>",
                    dataType: 'json',
                    data: {id, foto_name, foto_path},
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
    });

</script>