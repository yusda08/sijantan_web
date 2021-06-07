<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('home/profil'); ?>" class="nav-link btn btn-dark" alt="Edit Profile"><i class="fas fa-user"></i> <span class="d-none d-sm-inline-block">Profil</span></a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

    <li class="nav-item">
        <a class="nav-link btn btn-dark" href="<?= site_url("login/logout"); ?>">
            <i class="fas fa-lock-open"></i> <span class="d-none d-sm-inline-block">Sign Out</span>
        </a>
    </li>
</ul>