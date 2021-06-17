<?= js_asset('jquery.min.js', 'plugins/jquery/'); ?>
<?= js_asset('bootstrap.bundle.min.js', 'plugins/bootstrap/js/'); ?>
<?= js_asset('adminlte.js', 'dist/js/'); ?>
<?= js_asset('bs-stepper.min.js', 'plugins/bs-stepper/js/'); ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    const siteUrl = (dataUrl) => {
        return `<?=site_url();?>${dataUrl}`;
    };

    const baseUrl = (dataUrl) => {
        return `<?=base_url();?>${dataUrl}`;
    };

    $(document).ready(function () {
        var heights = $(".well_avarage").map(function () {
            return $(this).height();
        }).get(),maxHeight = Math.max.apply(null, heights);
        $(".well_avarage").height(maxHeight);
    });

    function mapOptions(lat, long, zoom = 13, mapTypeId = '') {
        return {
            zoom,
            mapTypeControl: true,
            center: new google.maps.LatLng(lat, long),
            mapTypeId,
            disableDefaultUI: true,
            overviewMapControl: true,
            streetViewControl: true
        }
    }

    function polyOptions(map, path, strokeColor = 'orange', strokeOpacity = 1.0, strokeWeight = 3) {
        return {
            map,
            path,
            strokeColor,
            strokeOpacity,
            strokeWeight,
            geodesic: true
        }
    }
</script>