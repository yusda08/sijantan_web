
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h3 class="alert alert-info text-center">Jalan <?= $row_jln['ruas_nama']; ?></h3>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Detail Jalan</h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-danger active"
                                                   href="<?= site_url('frontend/jalan'); ?>"><i
                                                            class="fa fa-backward"></i> Kembali</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item"><?= sprintfNumber($row_jln['ruas_no'], 3) . '. ' . $row_jln['ruas_nama']; ?></li>
                                        <li class="list-group-item">Panjang : <?= numberFormat($row_jln['ruas_panjang']); ?>
                                            Meter
                                        </li>
                                        <li class="list-group-item">Status : <?= $row_jln['ruas_status']; ?></li>
                                        <li class="list-group-item">Klasifikasi
                                            : <?= $row_jln['klasifikasi_nama'] . ' (' . $row_jln['klasifikasi_inisial'] . ')'; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Segmen Berdasarkan Lebar</h3>
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
                            <h3 class="card-title">Segmen Berdasarkan Kondisi</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
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
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Segmen Berdasarkan Permukaan</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
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
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Asset Jalan</h3>
                </div>
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            foreach ($getAssetJalan as $i => $row_asset) { ?>
                                <div class="carousel-item well_avarage <?= $i == 0 ? 'active' :'';?> ">
                                    <img class="d-block h-100 w-100" src="<?= base_url($row_asset['foto_path'] . $row_asset['foto_name']); ?>" alt="First slide">
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
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
    let map;
    const jalan_id = '<?=$jalan;?>';

    async function initMap() {
        let trackCoords = [], bounds = new google.maps.LatLngBounds(), lat = 0, long = 0;
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        new google.maps.KmlLayer({
            url: 'http://36.94.90.99/kml/tapin11.kml',
            map: map
        })
        const dataKoordinat = await getDataKoordinat();
        dataKoordinat.forEach((koor) => {
            lat = parseFloat(koor.latitude);
            long = parseFloat(koor.longitude);
            var myLatLng = new google.maps.LatLng(lat, long);
            trackCoords.push(new google.maps.LatLng(parseFloat(koor.latitude), parseFloat(koor.longitude)))
            bounds.extend(myLatLng);
        })
        new google.maps.Polyline(polyOption);
        map.fitBounds(bounds);
    }

    async function getDataKoordinat() {
        return await $.getJSON(siteUrl('frontend/jalan/load_data_koordinat'), {jalan_id})
    }

</script>