<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Tampilan
                </div>
                <div class="card-body">
                    <?= json_encode($log, 128);?>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card ">
                <div class="card-body p-0">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfbNIQF80jqSlMYpwmV4pKt00r6Wz6xyc&callback=initMap&libraries=&v=weekly" async ></script>
<script>
    let map;
    function initMap() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            zoom: 8,
            mapTypeControl: false,
            center: new google.maps.LatLng(-2.6190099, 115.2937061),
            mapTypeId: google.maps.MapTypeId.HYBRID,
            disableDefaultUI: true,
            overviewMapControl: true,
            streetViewControl: true
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        loadMaps()
    }
    google.maps.event.addDomListener(window, 'load', initMap);
    function loadMaps() {
        new google.maps.KmlLayer({
            url: 'http://36.94.90.99/kml/tapin11.kml',
            map: map
        })
    }
</script>