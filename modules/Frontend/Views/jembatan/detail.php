<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h3 class="alert alert-info text-center">Jembatan <?= $row_jembatan['nama']; ?></h3>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Detail Jembatan</h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-danger active" href="<?= site_url('frontend/jembatan'); ?>"><i
                                                        class="fa fa-backward"></i> Kembali</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">

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
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tipe dan Kondisi Jembatan</h3>
                            <div class="card-tools">

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
                                            <td><?= $row_kondisi['tipekondisi_nama']; ?></td>
                                            <td class="text-center"><?= $row_kondisi['tipe']; ?></td>
                                            <td class="text-center"><?= $row_kondisi['kondisi_nama']; ?></td>
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
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Asset Jembatan</h3>
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
    </div>
</div>
<?= $this->include('frontend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfbNIQF80jqSlMYpwmV4pKt00r6Wz6xyc&callback=initMap&libraries=&v=weekly"
async></script>
<script>
    let map, infoWindow;
    const jembatan_id = '<?= $jembatan; ?>';
    const dataJembatan = <?= json_encode($row_jembatan); ?>;

    async function initMap() {
        let trackCoords = []
        let bounds = new google.maps.LatLngBounds(), lat = 0, long = 0;
        map = new google.maps.Map(document.getElementById('map'), mapOptions(new google.maps.LatLng(lat, long)));
        new google.maps.KmlLayer({
            url: 'http://36.94.90.99/kml/tapin11.kml',
            map: map
        });
        infoWindow = new google.maps.InfoWindow({map: map});

        let marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(dataJembatan.latitude), parseFloat(dataJembatan.longitude)),
            map: map
        });
        marker.addListener("click", (e) => {
            infoWindow.setOptions({position: e.latLng, content: getPopUpJembatan(dataJembatan)})
            infoWindow.open(map, marker);
        });
    }
    function getPopUpJembatan(res) {
        return `<div id="content">
                        <h3 id="firstHeading" class="firstHeading">${res.nama}</h3>
                        <div id="bodyContent">
                            <ul>
                                <li>Nomor Jembatan: ${res.nomor}</li>
                                <li>Nama Ruas : ${res.ruas}</li>
                                <li>Panjang Jembatan: ${res.panjang} Meter</li>
                                <li>Lebar Jembatan: ${res.lebar} Meter</li>
                                <li>Jumlah Bentang: ${res.jumlah_bentang}</li>
                                <li>Kondisi Lantai : ${res.kondisi_nama}</li>
                                <li>Kecamatan : ${res.kecamatan}</li>
                            </ul>
                        </div>
                    </div>`;
    }


</script>