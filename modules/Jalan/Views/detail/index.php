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
    $('body').addClass('sidebar-collapse');
    let map;
    const jalan_id = '<?=$jalan;?>';

    async function initMap() {
        let mapOptions = {
            zoom: 12,
            mapTypeControl: true,
            center: new google.maps.LatLng(-2.6190099, 115.2937061),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            disableDefaultUI: true,
            overviewMapControl: true,
            streetViewControl: true
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        new google.maps.KmlLayer({
            url: 'http://36.94.90.99/kml/tapin11.kml',
            map: map
        })
        let flightPlanCoordinates = [];
        await $.getJSON(siteUrl('jalan/load_data_koordinat'), {jalan_id}, function (respon) {
            respon.forEach((res) => {
                flightPlanCoordinates.push({
                    'lat': parseFloat(res.longitude),
                    'lng': parseFloat(res.latitude)
                })
            })
        })
        const flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#00000",
            strokeOpacity: 1.0,
            strokeWeight: 3,
        });
        flightPath.setMap(map);
    }
</script>