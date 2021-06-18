<div class="container">
    <a href="<?=base_url('/');?>" class="navbar-brand">
        <img src="<?=logoKab();?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>Si-JanTan</strong></span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="<?=base_url('/');?>" class="nav-link"><strong style="color: #000000"><i class="fa fa-home"></i> Home</strong></a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url('frontend/jalan');?>" class="nav-link"><strong style="color: #000000"><i class="fa fa-road"></i> Data Jalan</strong></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><strong style="color: #000000"><i class="fa fa-bars"></i> Data Jembatan</strong></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><strong style="color: #000000"><i class="fa fa-pencil-alt"></i> Pengaduan</strong></a>
            </li>
        </ul>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-primary" href="<?=site_url('login');?>">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </li>
        </ul>
</div>