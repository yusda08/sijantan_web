<!-- ./wrapper -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>v-->

<?= js_asset('jquery.min.js', 'plugins/jquery/'); ?>
<?= js_asset('jquery-ui.min.js', 'plugins/jquery-ui/'); ?>
<?= js_asset('bootstrap.bundle.min.js', 'plugins/bootstrap/js/'); ?>
<?= js_asset('moment.min.js', 'plugins/moment/'); ?>
<?= js_asset('tempusdominus-bootstrap-4.min.js', 'plugins/tempusdominus-bootstrap-4/js/'); ?>
<?= js_asset('jquery.inputmask.bundle.min.js', 'plugins/inputmask/min/'); ?>
<?= js_asset('summernote-bs4.min.js', 'plugins/summernote/'); ?>
<?= js_asset('jquery.overlayScrollbars.min.js', 'plugins/overlayScrollbars/js/'); ?>
<?= js_asset('adminlte.js', 'dist/js/'); ?>
<?= js_asset('daterangepicker.js', 'plugins/daterangepicker/'); ?>
<?= js_asset('moment.min.js', 'plugins/moment/'); ?>
<?= js_asset('jquery.overlayScrollbars.min.js', 'plugins/overlayScrollbars/js/'); ?>
<?= js_asset('select2.full.min.js', 'plugins/select2/js/'); ?>
<?= js_asset('sweetalert2.min.js', 'plugins/sweetalert/dist/'); ?>
<?= js_asset('toastr.min.js', 'plugins/toastr/'); ?>
<?= js_asset('croppie.min.js', 'plugins/crop/'); ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>-->

<script>
    $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    });
    // $(".custom-file-input").on("change", function() {
    //     let fileName = $(this).val().split("\\").pop();
    //     $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    // });
    $(document).ready(function () {
        var heights = $(".well_avarage").map(function () {
            return $(this).height();
        }).get(), maxHeight = Math.max.apply(null, heights);
        $(".well_avarage").height(maxHeight);
    });

    $('[data-mask]').inputmask();

    $(function () {
        $('.datepicker').daterangepicker({
            "singleDatePicker": true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }, function (start, end, label) {
        });
        $.extend(true, $.fn.dataTable.defaults, {
            "searching": true
        });

        $('.tabel_3').DataTable({
            scrollY: '85vh',
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false
        });
        $('.tabel_4').DataTable({
            paging: false,
            searching: false,
            ordering: false,
            autoWidth: true,
            lengthChange: true
        });
        $('.tabel_2').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 25
        });
        $('.tabel_1').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 10
        });
        setTimeout(function () {
            $('#notiv').fadeOut('slow');
        }, 4000);

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function () {
            Toast.fire({
                type: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    })

    function callBackClassAfter(classParent, classAfter) {
        $(classParent).after(`<span class="${classAfter}"></span>`).css('margin-right', '10px');
        $(classParent).keyup(function () {
            $(this).css({
                'border': '1px solid #ccc',
                'background': 'none'
            });
        });
    }

    const siteUrl = (dataUrl) => {
        return `<?=site_url();?>${dataUrl}`;
    };

    const baseUrl = (dataUrl) => {
        return `<?=base_url();?>${dataUrl}`;
    };
    let defaultLat = parseFloat(-2.6190099);
    let defaultLng = parseFloat(115.2937061);

    function mapOptions(center, mapTypeId = 'terrain', zoom = 13) {
        return {
            zoom: zoom,
            mapTypeId: mapTypeId,
            mapTypeControl: true,
            disableDefaultUI: true,
            overviewMapControl: true,
            streetViewControl: true
        }
    }

    function polyOptions(map, path, strokeColor = 'orange', strokeOpacity = 1.0, strokeWeight = 4) {
        return {
            map: map,
            path: path,
            strokeColor: strokeColor,
            strokeOpacity: strokeOpacity,
            strokeWeight: strokeWeight,
            geodesic: true
        }
    }

    function addEvent(polyLine, event = 'mouseover', setOpt = {strokeColor: '#ff0000', strokeWeight: 5}) {
        return polyLine.addListener(event, function () {
            polyLine.setOptions(setOpt)
        });
    }


    const swalWithBootstrapButtons = Swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    });

    function notifSmartAlertNoReload(status, ket) {
        let tipe = status == true ? 'success' : 'error';
        Swal({
            position: 'top',
            type: tipe,
            title: ket,
            timer: 2500,
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })
    }

    function notifSmartAlert(status, ket) {
        if (status == true) {
            Swal({
                type: 'success',
                title: ket,
                timer: 2500,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            }).then((result) => {
                window.location.reload();
            });
        } else {
            Swal({
                position: 'top',
                type: 'error',
                title: ket,
                showConfirmButton: false,
                timer: 2000
            });
        }
    }
</script>