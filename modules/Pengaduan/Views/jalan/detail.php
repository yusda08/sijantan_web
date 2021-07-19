<?php
$countRes = count($getRespon);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Pengaduan Jalan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger active"
                                   href="<?= site_url($moduleUrl); ?>"><i
                                        class="fa fa-backward"></i> Kembali</a>
                            </li>
                        </ul>
                    </div>
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
                    <hr>
                    <?php
                    $disabled = $countRes != 0 ? 'disabled' : '';
                    $attr = "{$disabled} data-tiket='{$tiket}'";
                    echo btnAction('delete', $attr, ' Hapus', ' btn-delete-tiket')
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Asset Pengaduan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($getAsset as $asset) { ?>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="<?= base_url($asset['foto_path'] . $asset['foto_name']); ?>">
                                                    <div class="card mb-2 bg-gradient-dark">
                                                        <img height="200px" class="card-img-top"
                                                             src="<?= base_url($asset['foto_path'] . $asset['foto_name']); ?>"
                                                             alt="">
                                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                                            <h5 class="card-title alert alert-dark text-white" style="background: rgb(70, 70, 80, 0.6); font-weight: bold">
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        Latitude : <?= $asset['lat']; ?><br>Longitude : <?= $asset['long']; ?>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-danger btn-block btn-save" data-lat='<?= $asset['lat'] ?>' 
                                                        data-lng='<?= $asset['long'] ?>'
                                                        data-toggle='modal'
                                                        data-target='#viewMap'><i
                                                        class="fa fa-map-marked"></i>
                                                </button>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Respon Pengaduan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <?= form_open_multipart(site_url($moduleUrl . '/add_data'), ['class' => 'form-respon']); ?>
                                <div class="row form-group justify-content-between">
                                    <div class="col-md-4 col-6">
<!--                                            <button class="btn btn-primary btn-block btn-tambah" type="button"><i
                                                    class="fa fa-plus"></i> Respon
                                        </button>-->
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <button class="btn btn-success btn-block btn-save"><i
                                                class="fa fa-save"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <label>Keterangan</label>
                                        <textarea class="form-control keterangan" rows="3" name="keterangan[]"
                                                  placeholder="Keterangan" required></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-md-3 col-form-label">File Foto</label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" onchange="previewImg()" class="custom-file-input" id="file_foto"
                                                   name="file">
                                            <label class="custom-file-label" for="file_foto"></label>
                                            <note>Note : File yang di Upload Format harus Foto</note>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="file-preview"></div>
                                    </div>
                                </div>
                                <div class="addKeterangan"></div>
                                <?= getCsrf(); ?>
                                <input type="hidden" class="form-control tiket" name="tiket" value="<?= $tiket; ?>">
                                <?= form_close(); ?>
                            </div>
                            <div class="col-md-7">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm tabel_2">
                                        <thead>
                                            <tr>
                                                <th width="10%">No</th>
                                                <th>Isi</th>
                                                <th>Tanggal</th>
                                                <th>Gambar</th>
                                                <th width="5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($getRespon as $i => $row_respon) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $i + 1; ?></td>
                                                    <td><?= $row_respon['respon_ket']; ?></td>
                                                    <td class="text-center"><?= tgl_indo($row_respon['respon_tgl']); ?></td>
                                                    <td><a href="<?= base_url($row_respon['foto_path'] . $row_respon['foto_name']); ?>">
                                                            <img src="<?= base_url($row_respon['foto_path'] . $row_respon['foto_name']); ?> " class="img-fluid img-thumbnail" alt="File not exist"
                                                                 style="max-height:30%; max-width:30%">
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $attr = "data-id='{$row_respon['respon_id']}' 
                                                            data-isi='{$row_respon['respon_ket']}'
                                                            data-count='{$countRes}'
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
</div>
</div>

<div class="modal fade" id="viewMap" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><div class="modallabel"></div></h4>
            </div>
            <div class="modal-body">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5xedHfQY8mhyxhGmURgAiJgWkwk0yhlM&callback=initMap&libraries=&v=weekly" async></script>
<script>

                                                let map;
                                                let marker;
                                                $('#viewMap').on('shown.bs.modal', function (event) {
                                                    let button = $(event.relatedTarget);
                                                    let lat = button.data('lat');
                                                    let lng = button.data('lng');
                                                    let latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

                                                    marker.setPosition(latlng);
                                                    map.setCenter(latlng);


                                                });

                                                async function initMap() {
                                                    map = new google.maps.Map(document.getElementById("map"), {
                                                        zoom: 9,
                                                        center: {lat: defaultLat, lng: defaultLng},
                                                    });
                                                    marker = new google.maps.Marker({
                                                        position: {lat: defaultLat, lng: defaultLng},
                                                        map,
                                                        title: "Lokasi",
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
                                                        data: new FormData($(this)[0]),
                                                        dataType: 'json',
                                                        cache: false,
                                                        processData: false,
                                                        contentType: false,
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
                                                    const count = $(this).data('count');
                                                    const tiket = $(this).data('tiket');
                                                    const isi = $(this).data('isi')
                                                    console.log(count)
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
                                                                data: {id, tiket, count},
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
                                                $('.btn-delete-tiket').click(function (e) {
                                                    e.preventDefault();
                                                    const tiket = $(this).data('tiket');
                                                    swalWithBootstrapButtons({
                                                        title: 'Apa anda yakin menghapus Pengaduan dengan Tiekt : ' + tiket,
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
                                                                url: "<?= site_url($moduleUrl . '/delete_data_tiket'); ?>",
                                                                dataType: 'json',
                                                                data: {tiket},
                                                                success: (res) => {
                                                                    notifSmartAlertNoReload(res.status, res.ket)
                                                                    if (res.status == true) {
                                                                        setTimeout(function () {
                                                                            location.href = siteUrl('pengaduan/jalan')
                                                                        }, 2000)
                                                                    }
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