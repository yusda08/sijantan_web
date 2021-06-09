<!--<main>-->
<style>
    section.header{
        background: url('<?= base_url("assets/img/jalan-tapin.jpg") ?>') no-repeat fixed;
        /*background-repeat: repeat-x;*/
        background-size: cover;
        width: 100%;
    }
    .alert.alert-info{
        background-color: rgba(34, 122, 180, 0.5);
        /*opacity: 0.3%;*/
    }
    .title-app{
        color: #0c0c0c;
        font-weight: bold;
        /*opacity: 0.3%;*/
    }
</style>
<section class="header bg-gray mb-3">
    <div class="position-relative overflow-hidden mb-3 text-center">
        <div class="col-md-5 mx-auto my-3 title-app">
            <img class="img-responsive" src="<?= logoKab(); ?>" width="100px" hieght="100px">
            <h1 class="fw-normal">Si - Jantan</h1>
            <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this
                example based on Apple’s marketing pages.</p>
            <a class="btn btn-primary" href="#">Coming soon</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="alert alert-info">
                <button type="button" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <marquee><p style="font-family: Impact; font-size: 18pt">Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor!</p></marquee>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>

                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the card's
                        content.
                    </p>

                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>

                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the card's
                        content.
                    </p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Special title treatment</h6>

                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Special title treatment</h6>

                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        </div>

    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<?= $this->include('frontend/javasc');?>