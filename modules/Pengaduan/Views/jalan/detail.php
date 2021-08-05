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
                        <div class="col-md-8 text-justify"><?= $row_tiket['jalan_nama']; ?></div>
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
                                <?php
                                foreach ($getAsset as $asset) {
                                    $attMap = "data-lat='{$asset['lat']}' data-long='{$asset['long']}' data-aset_id='{$asset['aset_pengaduan_id']}'"
                                    ?>
                                    <div class="col-md-4">
                                        <a href="<?= localBase($asset['foto_path'] . $asset['foto_name']); ?>">
                                            <div class="card mb-2 bg-gradient-dark">
                                                <img height="200px" class="card-img-top"
                                                     src="<?= localBase($asset['foto_path'] . $asset['foto_name']); ?>"
                                                     alt="">
                                                <div class="card-img-overlay d-flex flex-column justify-content-end">
                                                    <h5 class="card-title alert alert-dark text-white"
                                                        style="background: rgb(70, 70, 80, 0.6); font-weight: bold">
                                                        Latitude : <?= $asset['lat']; ?><br>Longitude
                                                        : <?= $asset['long']; ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </a>
                                        <button <?= $attMap; ?> class="btn btn-info btn-flat btn-block view-map"><i
                                                    class="fa fa-map-marked"></i> View Map
                                        </button>
                                    </div>
                                    <?php
                                }
                                ?>
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
                                    <?= form_open_multipart($moduleUrl . '/add_data', ['class' => 'form-respon']); ?>

                                    <div class="row form-group col-md-12">
                                        <label>Keterangan</label>
                                        <textarea class="form-control keterangan" rows="3" name="keterangan"
                                                  placeholder="Keterangan" required></textarea>
                                    </div>
                                    <div class="row form-group col-md-12">

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file_images"
                                                   id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="addKeterangan"></div>
                                    <?= getCsrf(); ?>
                                    <input type="hidden" class="form-control name_image" name="name_image">
                                    <input type="hidden" class="form-control tiket" name="tiket" value="<?= $tiket; ?>">
                                    <div class="row form-group justify-content-between">
                                        <!--                                        <div class="col-md-4 col-6">-->
                                        <!--                                            <button class="btn btn-primary btn-block btn-tambah" type="button"><i-->
                                        <!--                                                        class="fa fa-plus"></i> Respon-->
                                        <!--                                            </button>-->
                                        <!--                                        </div>-->
                                        <div class="col-md-4 col-6">
                                            <button class="btn btn-success btn-block btn-save"><i
                                                        class="fa fa-save"></i>
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
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
                                                <th width="20%">Foto</th>
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
                                                    <td class="text-center">
                                                        <?php
                                                        if ($row_respon['foto_name']) { ?>
                                                            <a href="<?= localBase($row_respon['foto_path'] . $row_respon['foto_name']); ?>">
                                                                <img height="50px" class="card-img-top"
                                                                     src="<?= localBase($row_respon['foto_path'] . $row_respon['foto_name']); ?>"
                                                                     alt="">
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $attr = "data-id='{$row_respon['respon_id']}' 
                                                            data-isi='{$row_respon['respon_ket']}'
                                                            data-count='{$countRes}'
                                                            data-foto_path='{$row_respon['foto_path']}'
                                                            data-foto_name='{$row_respon['foto_name']}'
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
            <div class="modal-header">
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel">
                    <div class="modallabel"></div>
                </h4>
            </div>
            <div class="modal-body">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5xedHfQY8mhyxhGmURgAiJgWkwk0yhlM&callback=initMap&libraries=&v=weekly"
        async></script>
<script>
    let map;
    let marker;
    async function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: {lat: defaultLat, lng: defaultLng},
        });
        marker = new google.maps.Marker({
            position: {lat: defaultLat, lng: defaultLng},
            map,
            title: "Lokasi",
        });
    }

    $('.view-map').click(async function () {
        const lat = $(this).data('lat')
        const long = $(this).data('long')
        const aset_id = $(this).data('aset_id')
        const thisTag = $('#viewMap')
        thisTag.modal('show')

        let latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(long));
        marker.setPosition(latlng);
        map.setCenter(latlng);
        const contentString = await getPopUp(aset_id);
        const infoWindow = new google.maps.InfoWindow();
        marker.addListener("click", (e) => {
            infoWindow.setOptions({position: e.latlng, content: contentString})
            infoWindow.open(map, marker);
        });
    });

    async function getPopUp(aset_id) {
        const row = await getPengaduanJalanAset(aset_id);
        console.log(row)
        return `<div id="content">
                    <h3 id="firstHeading" class="firstHeading">${row.jalan_nama}</h3>
<img src="${baseUrl(`/${row.foto_path}${row.foto_name}`)}" class="img-bordered" style="width: 200px; height: 150px">
<hr>
                        <div id="bodyContent">
                            <ul>
                            <li>Nama Jalan : ${row.jalan_nama}</li>
                            <li>Nama Pengadu : ${row.pengadu_nama}</li>
                            <li>No HP : ${row.pengadu_no_hp}</li>
                            <li>Ket : ${row.pengadu_ket}</li>
                            </ul>
                        </div>
                </div>`;
    }

    async function getPengaduanJalanAset(aset_id = null) {
        return await $.getJSON(siteUrl(`<?=$moduleUrl;?>/load_pengaduan_aset`), {aset_id})
    }

    $(".custom-file-input").on("change", function () {
        let fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        $('.name_image').val(fileName)
    });


    $('.btn-tambah').on('click', function (e) {
        e.preventDefault();
        let htmls = `<div class="row form-group element-keterangan">
                        <div class="col-11"><textarea class="form-control keterangan" rows="3" name="keterangan[]" placeholder="Keterangan" required></textarea></div>
                        <div class="col-1"><button class="btn btn-danger btn-flat btn-xs btn-hapus" type="button"><i class="fa fa-trash"></i></button></div>
                     </div>`;
        $('.addKeterangan').append(htmls);
    });
    $(".addKeterangan").on('click', '.btn-hapus', function () {
        $(this).closest('.element-keterangan').remove();
    });

    $('.btn-save').click(function (e) {
        e.preventDefault();
        let data = new FormData($('.form-respon')[0]);
        $.ajax({
            type: 'POST',
            url: $('.form-respon').attr('action'),
            data: data,
            dataType: 'json',
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: () => {
                $(this).html(`<i class="fa fa-spin fa-spinner"></i> Loading . . .`)
                $(this).prop('disabled', true)
            },
            complete: () => {
                $(this).html(`<i class="fa fa-save"></i>  &nbsp; Simpan`)
                $(this).prop('disabled', false)
            },
            success: (res) => {
                // console.log(res)
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
        const foto_name = $(this).data('foto_name');
        const foto_path = $(this).data('foto_path');
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
                    data: {id, tiket, count, foto_name, foto_path},
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
    })
</script>