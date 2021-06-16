<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
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
            <div class="row">
                <div class="col-md-6">
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
</script>