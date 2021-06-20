<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Jalan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger active"
                                   href="<?= site_url('jalan/input_data'); ?>"><i
                                            class="fa fa-backward"></i> Kembali</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $attrAdd = "data-jalan_id='{$jalan}' data-ruas_nama='{$row_jln['ruas_nama']}'";
                    echo btnAction('update', $attrAdd, 'Edit', ' btn-update');
                    echo btnAction('delete', $attrAdd, 'Hapus', ' btn-delete');
                    ?>

                    <ul class="list-group">
                        <li class="list-group-item"><?= sprintfNumber($row_jln['ruas_no'], 3) . '. ' . $row_jln['ruas_nama']; ?></li>
                        <li class="list-group-item">Panjang : <?= numberFormat($row_jln['ruas_panjang']); ?>
                            Meter
                        </li>
                        <li class="list-group-item">Status : <?= $row_jln['ruas_status']; ?></li>
                        <li class="list-group-item">Klasifikasi
                            : <?= $row_jln['klasifikasi_nama'] . ' (' . $row_jln['klasifikasi_inisial'] . ')'; ?></li>
                        <li class="list-group-item">Nama Pangkal : <?= $row_jln['ruas_nama_pangkal']; ?></li>
                        <li class="list-group-item">Nama Ujung : <?= $row_jln['ruas_nama_ujung']; ?></li>
                        <li class="list-group-item">Titik Pangkal : <?= $row_jln['ruas_titik_pangkal']; ?></li>
                        <li class="list-group-item">Titik Ujung : <?= $row_jln['ruas_titik_ujung']; ?></li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Segmen Berdasarkan Kondisi</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <?php
                                        $attrAdd = "data-aksi='kondisi' 
                                        data-jalan_id='{$row_jln['jalan_id']}' 
                                         data-ruas_panjang='{$row_jln['ruas_panjang']}'";
                                        echo btnAction('add', $attrAdd, '', ' btn-add-aksi');
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Kondisi</th>
                                    <th>Panjang<br>(Meter)</th>
                                    <th>Persentase<br>(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $persenKondisiTtl = 0;
                                $panjangKondisiTtl = 0;
                                foreach (json_decode($getKondisiJalan) as $row_kondisi) {
                                    $persenKondisi = (float)@($row_kondisi->panjang / $row_jln['ruas_panjang']) * 100;
                                    $persenKondisiTtl += $persenKondisi;
                                    $panjangKondisiTtl += $row_kondisi->panjang;
                                    ?>
                                    <tr>
                                        <td><?= $row_kondisi->kondisi_nama; ?></td>
                                        <td class="text-center"><?= numberFormat($row_kondisi->panjang); ?></td>
                                        <td class="text-center"><?= numberFormat($persenKondisi, 2); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center"><?= numberFormat($panjangKondisiTtl); ?></th>
                                    <th class="text-center"><?= numberFormat($persenKondisiTtl); ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Segmen Berdasarkan Lebar</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <?php
                                        $attrAdd = "data-aksi='lebar' 
                                        data-jalan_id='{$row_jln['jalan_id']}' 
                                         data-ruas_panjang='{$row_jln['ruas_panjang']}'";
                                        echo btnAction('add', $attrAdd, '', ' btn-add-aksi');
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Lebar</th>
                                    <th>Panjang<br>(Meter)</th>
                                    <th>Persentase<br>(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $persenLebarTtl = 0;
                                $panjangLebarTtl = 0;
                                foreach (json_decode($getLebarJalan) as $row_lebar) {
                                    $persenLebar = (float)@($row_lebar->panjang / $row_jln['ruas_panjang']) * 100;
                                    $persenLebarTtl += $persenLebar;
                                    $panjangLebarTtl += $row_lebar->panjang;
                                    ?>
                                    <tr>
                                        <td><?= $row_lebar->lebar_nama; ?></td>
                                        <td class="text-center"><?= numberFormat($row_lebar->panjang); ?></td>
                                        <td class="text-center"><?= numberFormat($persenLebar, 2); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center"><?= numberFormat($panjangLebarTtl); ?></th>
                                    <th class="text-center"><?= numberFormat($persenLebarTtl); ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Segmen Berdasarkan Permukaan</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <?php
                                        $attrAdd = "data-aksi='permukaan'  data-jalan_id='{$row_jln['jalan_id']}' data-ruas_panjang='{$row_jln['ruas_panjang']}'";
                                        echo btnAction('add', $attrAdd, '', ' btn-add-aksi');
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Permukaan</th>
                                    <th>Panjang<br>(Meter)</th>
                                    <th>Persentase<br>(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $persenPermukaanTtl = 0;
                                $panjangPermukaanTtl = 0;
                                foreach (json_decode($getPermukaanJalan) as $row_permukaan) {
                                    $persenPermukaan = (float)@($row_permukaan->panjang / $row_jln['ruas_panjang']) * 100;
                                    $persenPermukaanTtl += $persenPermukaan;
                                    $panjangPermukaanTtl += $row_permukaan->panjang;
                                    ?>
                                    <tr>
                                        <td><?= $row_permukaan->permukaan_nama; ?></td>
                                        <td class="text-center"><?= numberFormat($row_permukaan->panjang); ?></td>
                                        <td class="text-center"><?= numberFormat($persenPermukaan, 2); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center"><?= numberFormat($panjangPermukaanTtl); ?></th>
                                    <th class="text-center"><?= numberFormat($persenPermukaanTtl); ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Asset Jalan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <?php
                                $attrAset = "data-jalan_id='{$row_jln['jalan_id']}'";
                                echo btnAction('add', $attrAset, ' Asset', ' btn-asset'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        foreach ($getAssetJalan as $row_asset) { ?>
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
<div class="modal fade" id="modal-add-aksi" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open($moduleUrl . '/add_kondisi', ['class' => 'form-kondisi']); ?>
            <div class="modal-header">
                <h5 class="modal-title label_head"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kondisi</label>
                    <select class="form-control select2 select-aksi" name="aksi_id" style="width: 100%">

                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Panjang</span>
                        </div>
                        <input type="text" class="form-control panjang" name="panjang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control keterangan" name="keterangan"></textarea>
                </div>
                <input type="hidden" class="form-control jalan_id" name="jalan_id">
                <input type="hidden" class="form-control ruas_panjang" name="ruas_panjang">
                <input type="hidden" class="form-control aksi" name="aksi">
                <?= getCsrf(); ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
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
                <input type="hidden" class="form-control jalan_id" name="jalan_id">
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

    $('.btn-update').click(function () {
        const jalan_id = $(this).data('jalan_id')
        location.href = siteUrl(`jalan/input_data/form_update?jalan=${jalan_id}`);
    })
    $('.btn-delete').click(function () {
        const jalan_id = $(this).data('jalan_id')
        const ruas_nama = $(this).data('ruas_nama')
        swalWithBootstrapButtons({
            title: 'Apa anda yakin menghapus Data Jalan : ' + ruas_nama,
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
                    url: "<?= site_url('jalan/input_data/delete_data'); ?>",
                    dataType: 'json',
                    data: {jalan_id},
                    success: (res) => {
                        setInterval(notifSmartAlert(res.status, res.ket), 3000)
                        if(res.status == true){
                            location.href = siteUrl(`jalan/input_data`);
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
    })

    $('.btn-add-aksi').click(function () {
        const aksi = $(this).data('aksi');
        const thisTag = $('#modal-add-aksi')
        thisTag.modal('show')
        if (aksi == 'kondisi') {
            $.getJSON(siteUrl('utility/kondisi_jalan/load_json'), function (respon) {
                let htmls = '<option selected disabled value="">.: Kondisi Jalan :.</option>';
                respon.forEach((res) => {
                    htmls += `<option value="${res.kondisi_id}">${res.kondisi_nama}</option>`;
                })
                $('.select-aksi').html(htmls)
            })
        } else if (aksi == 'permukaan') {
            $.getJSON(siteUrl('utility/permukaan_jalan/load_json'), function (respon) {
                let htmls = '<option selected disabled value="">.: Permukaan Jalan :.</option>';
                console.log(respon)
                respon.forEach((res) => {
                    htmls += `<option value="${res.permukaan_id}">${res.permukaan_nama}</option>`;
                })
                $('.select-aksi').html(htmls)
            })
        } else if (aksi == 'lebar') {
            $.getJSON(siteUrl('utility/lebar_jalan/load_json'), function (respon) {
                let htmls = '<option selected disabled value="">.: Lebar Jalan :.</option>';
                console.log(respon)
                respon.forEach((res) => {
                    htmls += `<option value="${res.lebar_id}">${res.lebar_nama}</option>`;
                })
                $('.select-aksi').html(htmls)
            })
        } else {
            $('.select-aksi').append(`<option selected disabled value="">.: Kosong :.</option>`)
        }
        thisTag.find('.modal-title').text(`Form Input ${aksi}`);
        thisTag.find('.modal-body input.jalan_id').val($(this).data('jalan_id'));
        thisTag.find('.modal-body input.ruas_panjang').val($(this).data('ruas_panjang'));
        thisTag.find('.modal-body input.aksi').val(aksi);
    })
    $('.btn-asset').click(function () {
        const thisTag = $('#modal-add-asset')
        thisTag.modal('show')
        thisTag.find('.modal-title').text(`Form Input Asset`);
        thisTag.find('.modal-body input.jalan_id').val($(this).data('jalan_id'));
    })

    $('.select-aksi').change(function () {
        const aksi_id = $(this).val();
        const jalan_id = $('.jalan_id').val();
        const aksi = $('.aksi').val();
        $.getJSON(siteUrl(`jalan/load_${aksi}/${jalan_id}/${aksi_id}`), function (respon) {
            $('.panjang').val(respon.panjang);
            $('.keterangan').text(respon.keterangan);
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

    $('.panjang').keyup(function () {
        const panjang = $(this).val();
        const ruas_panjang = $('.ruas_panjang').val();

    })

    $('body').addClass('sidebar-collapse');
    let map, infowindow;
    const jalan_id = '<?=$jalan;?>';

    async function initMap() {
        let trackCoords = []
        let bounds = new google.maps.LatLngBounds(), lat = 0, long = 0;
        map = new google.maps.Map(document.getElementById('map'), mapOptions(new google.maps.LatLng(lat, long)));
        new google.maps.KmlLayer({
            url: 'http://36.94.90.99/kml/tapin11.kml',
            map: map
        })
        const dataKoordinat = await getDataKoordinat();
        dataKoordinat.forEach((koor) => {
            lat = parseFloat(koor.latitude);
            long = parseFloat(koor.longitude);
            const myLatLng = new google.maps.LatLng(lat, long);
            trackCoords.push(myLatLng)
            bounds.extend(myLatLng);
        })
        const polyLine = new google.maps.Polyline(polyOptions(map, trackCoords));
        const contentString = await getPopUp(jalan_id);
        const setOpt = {strokeColor: '#ff0000', strokeWeight:5 }
        addEvent(polyLine, 'mouseover', setOpt);
        addEvent(polyLine, 'mouseout', {strokeColor: 'orange', strokeWeight:4 });
        const infoWindow = new google.maps.InfoWindow();
        polyLine.addListener('click', function (e) {
            polyLine.setOptions(setOpt)
            infoWindow.setOptions({map:map, position: e.latLng, content: contentString})
        });
        map.fitBounds(bounds);
        // flightPath.setMap(map);
    }

    async function getPopUp(jalan_id) {
        const dataJalan = await getDataJalan(jalan_id);
        console.log(dataJalan)
        return `<div id="content">
                    <h3 id="firstHeading" class="firstHeading">${dataJalan.ruas_nama}</h3>
                        <div id="bodyContent">
                            <ul>
                            <li>Nomor Ruas : ${dataJalan.ruas_no}</li>
                            <li>Panjang Ruas : ${dataJalan.ruas_panjang} Meter</li>
                            <li>Kecamatan : ${dataJalan.kecamatan}</li>
                            <li>Klasifikasi : ${dataJalan.klasifikasi_nama}</li>
                            <li>Status Ruas : ${dataJalan.ruas_status}</li>
                            <li>Nama Pangkal : ${dataJalan.ruas_nama_pangkal}</li>
                            <li>Nama Ujung : ${dataJalan.ruas_nama_ujung}</li>
                            <li>Titik Pangkal : ${dataJalan.ruas_titik_pangkal}</li>
                            <li>Titik Ujung : ${dataJalan.ruas_titik_ujung}</li>
                            </ul>
                        </div>
                </div>`;
    }

    async function getDataJalan(jalan_id) {
        return await $.getJSON(siteUrl(`jalan/load_data_jalan/${jalan_id}`))
    }

    async function getDataKoordinat() {
        return await $.getJSON(siteUrl('jalan/load_data_koordinat'), {jalan_id})
    }

</script>