<!--<main>-->
<style>
    section.header {
        background: url('<?= base_url("assets/img/jalan-tapin2.jpg") ?>') no-repeat fixed;
        background-size: 100% 100%, cover;
        min-height: 450px;
    }

    .alert.alert-info {
        background-color: rgba(34, 122, 180, 0.5);
        min-width: 1200px;
        /*opacity: 0.3%;*/
    }

    .title-app {
        color: #0c0c0c;
        font-weight: bold;
        /*opacity: 0.3%;*/
    }


</style>
<section class="header bg-gray mb-3">
    <div class="position-relative overflow-hidden mb-3 text-center">
        <div class="col-md-5 mx-auto my-3 title-app ">
            <img class="img-responsive" src="<?= logoKab(); ?>" width="100px" hieght="100px">
            <h1 class="fw-normal">AKSI Si-JanTan</h1>

            <h3>Pemerintah Kabupaten Tapin<br><small>Dinas Pekerjaan Umum Dan Penataan Ruang</small></h3>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="alert alert-info d-none d-md-block">
                <button type="button" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" class="close"
                        data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
                <marquee><p style="font-family: Impact; font-size: 18pt"><?= $running['run_ket']; ?></p></marquee>
            </div>
        </div>
    </div>
</section>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-info card-outline">
                <div class="card-body p-0">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-info card-outline">
                <div class="card-body text-center">
                    <h1 class="">Selamat Datang</h1>

                    <p class="card-text" style="font-size: 14pt">
                        Sistem Informasi Jalan dan Jembatan Pemerintah Kabupaten Tapin adalah suatu sistem informasi
                        yang menyajikan peta digital
                        berbasis WebGIS untuk memudahkan pencarian data dan informasi tentang peta wilayah jaringan
                        jalan dan jembatan yang ada di wilayah Kabupaten Tapin
                    </p>
                    <div class="row">
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>0 Ruas</h3>

                                    <p>Jaringan Jalan</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-road"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>0 Titik</h3>

                                    <p>Jembatan</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-box shadow-none bg-info">
                                <span class="info-box-icon "><i class="fa fa-road"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Panjang Jalan</span>
                                    <span class="info-box-number">0 KM</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-box shadow-none bg-info">
                                <span class="info-box-icon "><i class="fa fa-road"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Panjang Jembatan</span>
                                    <span class="info-box-number">0 Meter</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h1>Hubungi Kami.</h1>
                                <p class="card-text">
                                    <?= $unit['alamat'] . '<br> No Telpon - ' . $unit['no_telpon'] . ' Email - ' . $unit['email']; ?>
                                </p>
                                <div class="row  justify-content-center">
                                    <div class="col-md-3 col-6">
                                        <a href="#">
                                            <img src="<?= base_url('assets/img/google-play-badge.png'); ?>"
                                                 class="img-responsive" style="width: 90%">
                                        </a>
                                    </div>
                                </div>
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <a href="<?= $unit['link_fb']; ?>" target="_blank" class="step-trigger"
                                               role="tab"
                                               aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="16" height="16"
                                                     fill="currentColor"
                                                     class="bi bi-facebook"
                                                     viewBox="0 0 16 16"><path
                                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/><svg>
                                            </span>
                                                <span class="bs-stepper-label">Facebook</span>
                                            </a>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <a href="<?= $unit['link_instagram']; ?>" target="_blank"
                                               class="step-trigger" role="tab"
                                               aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16"><path
                                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                                </svg>
                                            </span>
                                                <span class="bs-stepper-label">Instagram</span>
                                            </a>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <a href="<?= $unit['link_youtube']; ?>" target="_blank" class="step-trigger"
                                               role="tab"
                                               aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     width="16" height="16"
                                                     fill="currentColor"
                                                     class="bi bi-youtube"
                                                     viewBox="0 0 16 16"><path
                                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                                                </svg>
                                            </span>
                                                <span class="bs-stepper-label">Youtube</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <?= $this->include('frontend/javasc'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5xedHfQY8mhyxhGmURgAiJgWkwk0yhlM&callback=initMap&libraries=&v=weekly"
            async></script>
    <script>
        let map;

        async function initMap() {
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            new google.maps.KmlLayer({
                url: 'http://36.94.90.99/kml/tapin11.kml',
                map: map
            })
            const dataJalan = await getDataJalan();
            const dataKoordinat = await getDataKoordinat();
            let flightPath = [];
            dataJalan.forEach((jln) => {
                let trackCoords = [];
                dataKoordinat.forEach((koor) => {
                    if (koor.jalan_id == jln.jalan_id) {
                        trackCoords.push(new google.maps.LatLng(parseFloat(koor.latitude), parseFloat(koor.longitude)))
                    }
                })
                flightPath.push(new google.maps.Polyline(polyOptions(map:map, path: trackCoords)))
                trackCoords.clear;
            })
        }

        async function getDataJalan() {
            return await $.getJSON(siteUrl('frontend/jalan/load_data_jalan'))
        }

        async function getDataKoordinat() {
            return await $.getJSON(siteUrl('frontend/jalan/load_data_koordinat'))
        }

    </script>