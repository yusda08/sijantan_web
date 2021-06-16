<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Jalan</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger active" href="<?= site_url('jalan/input_data'); ?>"><i
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
                        <li class="list-group-item"><?= sprintfNumber($row_jln['ruas_no'], 3) . '. ' . $row_jln['ruas_nama']; ?></li>
                        <li class="list-group-item">Panjang : <?= numberFormat($row_jln['ruas_panjang']); ?> Meter</li>
                        <li class="list-group-item">Status : <?= $row_jln['ruas_status']; ?></li>
                        <li class="list-group-item">Klasifikasi
                            : <?= $row_jln['klasifikasi_nama'] . ' (' . $row_jln['klasifikasi_inisial'] . ')'; ?></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Segmen Berdasarkan Kondisi</h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <?php
                                        $attrAdd = "data-jalan_id='{$row_jln['jalan_id']}' data-ruas_panjang='{$row_jln['ruas_panjang']}'";
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
                                    $persenKondisi = (float) @($row_kondisi->panjang/$row_jln['ruas_panjang'])*100;
                                    $persenKondisiTtl += $persenKondisi;
                                    $panjangKondisiTtl += $row_kondisi->panjang;
                                    ?>
                                    <tr>
                                        <td><?= $row_kondisi->kondisi_nama; ?></td>
                                        <td class="text-center"><?=  numberFormat($row_kondisi->panjang); ?></td>
                                        <td class="text-center"><?= numberFormat($persenKondisi, 2); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th class="text-center"><?=numberFormat($panjangKondisiTtl);?></th>
                                    <th class="text-center" ><?=numberFormat($persenKondisiTtl);?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-outline">
                <div class="card-body p-0">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-add-kondisi" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open($moduleUrl.'/add_kondisi', ['class' => 'form-kondisi']);?>
            <div class="modal-header">
                <h5 class="modal-title label_head"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kondisi</label>
                    <select class="form-control select2 select-kondisi" name="kondisi_id" style="width: 100%">
                        <option selected disabled value="">.: Kondisi Jalan :.</option>
                        <?php
                        foreach ($getKondisi as $row_kon) {
                            echo "<option value='{$row_kon['kondisi_id']}'>{$row_kon['kondisi_nama']}</option>";
                        }
                        ?>
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
                <?= getCsrf();?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close();?>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfbNIQF80jqSlMYpwmV4pKt00r6Wz6xyc&callback=initMap&libraries=&v=weekly"
        async></script>
<script>
    $('.btn-add-kondisi').click(function () {
        const jalan_id = $(this).data('jalan_id');
        const ruas_panjang = $(this).data('ruas_panjang');
        const thisTag = $('#modal-add-kondisi')
        thisTag.modal('show')
        thisTag.find('.modal-title').text('Form Input Kondisi');
        thisTag.find('.modal-body input.jalan_id').val(jalan_id);
        thisTag.find('.modal-body input.ruas_panjang').val(ruas_panjang);
    })
    $('.select-kondisi').change(function () {
        const kondisi_id = $(this).val();
        const jalan_id = $('.jalan_id').val();
        $.getJSON(siteUrl(`jalan/load_kondisi/${jalan_id}/${kondisi_id}`), function (respon) {
            $('.panjang').val(respon.panjang);
            $('.keterangan').text(respon.keterangan);
        })
    })

    $('.panjang').keyup(function () {
        const panjang = $(this).val();
        const ruas_panjang = $('.ruas_panjang').val();

    })



    $('body').addClass('sidebar-collapse');
    let map;
    const jalan_id = '<?=$jalan;?>';

    async function initMap() {
        let flightPlanCoordinates = [];
        let lat = 0;
        let long = 0;
        await $.getJSON(siteUrl('jalan/load_data_koordinat'), {jalan_id}, function (respon) {
            respon.forEach((res) => {
                lat = parseFloat(res.longitude);
                long = parseFloat(res.latitude);
                flightPlanCoordinates.push({
                    'lat': parseFloat(res.longitude),
                    'lng': parseFloat(res.latitude)
                })
            })
        })
        const flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#ff0000",
            strokeOpacity: 1.0,
            strokeWeight: 3,
        });
        const mapOptions = {
            zoom: 13,
            mapTypeControl: true,
            center: new google.maps.LatLng(lat, long),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            disableDefaultUI: true,
            overviewMapControl: true,
            streetViewControl: true
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        flightPath.setMap(map);
    }
</script>