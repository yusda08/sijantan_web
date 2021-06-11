<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Tampilan
                </div>
                <div class="card-body">

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

<script>
    // let map;
    //
    // // function initMap() {
    // //     map = new google.maps.Map(document.getElementById("map"), {
    // //         center: {lat: -2.932641, lng: 115.162938},
    // //         zoom: 9,
    // //         center: new google.maps.LatLng(-2.6190099, 115.2937061),
    // //         mapTypeId: google.maps.MapTypeId.HYBRID,
    // //         disableDefaultUI: true,
    // //         overviewMapControl: true,
    // //         streetViewControl: true
    // //     });
    // //     loadMaps()
    // // }
    //
    //
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
    console.table(loadMaps())
    function loadMaps() {
        mapKab = new google.maps.KmlLayer({
            url: 'http://36.94.90.99/kml/tapin11.kml',
            map: map
        })
    }

    // var map;
    // var src = 'http://36.94.90.99/kml/tapin11.kml';
    // var src = 'https://developers.google.com/maps/documentation/javascript/examples/kml/westcampus.kml';
    // console.log(src)

    // function initMap() {
    //     map = new google.maps.Map(document.getElementById('map'), {
    //         center: new google.maps.LatLng(-2.6190099, 115.2937061),
    //         zoom: 8,
    //         mapTypeId: 'terrain'
    //     });
    //
    //     var kmlLayer = new google.maps.KmlLayer(src, {
    //         suppressInfoWindows: true,
    //         preserveViewport: false,
    //         map: map
    //     });
    //     kmlLayer.addListener('click', function(event) {
    //         var content = event.featureData.infoWindowHtml;
    //         var testimonial = document.getElementById('capture');
    //         testimonial.innerHTML = content;
    //     });
    // }
</script>