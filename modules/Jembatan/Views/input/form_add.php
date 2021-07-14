<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?= form_open(site_url($moduleUrl . '/add_data'), ['class' => 'form-input-data']); ?>
        <div class="modal-header">
            <h5 class="modal-title label_head">Form Input Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-md-3 col-form-label"></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nomor Jembatan</span>
                        </div>
                        <input type="text" class="form-control nomor" name="nomor" required>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Nama Jembatan</label>
                <div class="col-md-9">
                    <input class="form-control nama" name="nama" required>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Nama Ruas</label>
                <div class="col-md-9">
                    <input class="form-control ruas" name="ruas" required>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">STA</label>
                <div class="col-md-9">
                    <input class="form-control sta" name="sta" required>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Kecamatan</label>
                <div class="col-md-9">
                    <select class="select2 form-control select-kecamatan" multiple name="kecamatan[]" style="width: 100%"
                            required>
                                <?php
                                foreach ($getKecamatan as $row_kec) {
                                    echo "<option value='{$row_kec['kec_nama']}'>{$row_kec['kec_nama']}</option>";
                                }
                                ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Panjang Jembatan</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input class="form-control panjang" name="panjang" required>
                        <div class="input-group-append">
                            <span class="input-group-text">METER</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Lebar Jembatan</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input class="form-control lebar" name="lebar" required>
                        <div class="input-group-append">
                            <span class="input-group-text">METER</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Jumlah Bentang</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input class="form-control jumlah_bentang" name="jumlah_bentang" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Bentang</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-md-3 col-form-label">Kondisi Lantai Jembatan</label>
                <div class="col-md-9">
                    <select class="select2 form-control select-kondisi" name="kondisi_id" style="width: 100%"
                            required>
                        <option selected disabled value="">.: Pilih Kondisi :.</option>
                        <?php
                        foreach ($getKondisi as $row_kondisi) {
                            echo "<option value='{$row_kondisi['kondisi_id']}'>{$row_kondisi['kondisi_nama']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php foreach ($getTipeKondisi as $rowtipe) { ?>
                <div class="row form-group">
                    <label class="col-md-3 col-form-label">Tipe <?= $rowtipe['tipekondisi_nama'] ?></label>
                    <div class="col-md-4">
                        <input class="form-control tipe<?= $rowtipe['tipekondisi_id'] ?>" name="tipe<?= $rowtipe['tipekondisi_id'] ?>" placeholder="tipe" required>
                    </div>
                    <div class="col-md-4">
                        <select class="select2 form-control tipekondisi<?= $rowtipe['tipekondisi_id'] ?>" name="tipekondisi<?= $rowtipe['tipekondisi_id'] ?>" style="width: 100%"
                                required>
                            <option selected disabled value="">.: Pilih Kondisi :.</option>
                            <?php
                            foreach ($getKondisi as $row_kondisi) {
                                echo "<option value='{$row_kondisi['kondisi_id']}'>{$row_kondisi['kondisi_nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row form-group">
                <label class="col-md-3 col-form-label">Latitude </label>
                <div class="col-md-6">
                    <input type="text" class="form-control latitude" id="latitude" name="latitude">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Longitude </label>
                <div class="col-md-6">
                    <input type="text" class="form-control longitude" id="longitude" name="longitude">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary ceklokasi"><i class="fa fa-search"></i> Cek lokasi</button>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="card-body p-0">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <?= getCsrf(); ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-simpan"><i class="fa fa-save"></i> Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfbNIQF80jqSlMYpwmV4pKt00r6Wz6xyc&callback=initMap&libraries=&v=weekly" async></script>

<script>

    let map;
    let bounds = [];
    let features = [];
    let marker;

    async function initMap() {
        let lat = -2.916075;
        let lng = 115.046600;
        const myLatLng = {lat: lat, lng: lng};

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: myLatLng,
        });
        marker = new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Lokasi Jembatan",
        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
        });

        google.maps.event.addListener(map, 'click', function (event) {
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
            marker.setPosition(event.latLng);
        });
    }
    
    $('.ceklokasi').click(function () {
        let lat = parseFloat($('#latitude').val());
        let lng = parseFloat($('#longitude').val());
        let latlng = new google.maps.LatLng(lat, lng);
        marker.setPosition(latlng);
    });


</script>