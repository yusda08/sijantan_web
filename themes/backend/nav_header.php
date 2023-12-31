<?php
$a = aksesLog();
?>

<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
        <a href="<?= site_url('home/profil'); ?>" class="nav-link btn btn-dark" alt="Edit Profile"><i class="fas fa-user"></i> <span class="d-none d-sm-inline-block">Profil</span></a>
    </li>
</ul>
<?= form_open('home/set_session_tahun', ['method' => 'post', 'class' => 'form-inline ml-3']);?>
<div class="input-group input-group-sm">
    <select class="form-control bg-white form-control-navbar d-none d-sm-inline-block" name="tahun" >
        <?php
        for($tahun = 2021; $tahun <= date('Y'); $tahun++){
            $selected = $tahun == $a['tahun'] ? 'selected' :'';
            echo "<option $selected value='$tahun'>$tahun</option>";
        }?>
    </select>
    <div class="input-group d-none d-sm-inline-block">
        <div class="input-group-append">
            <button class="nav-link btn btn-dark">Set</button>
        </div>
    </div>
</div>
<?= form_close();?>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link btn btn-dark" href="<?= site_url("login/logout"); ?>">
            <i class="fas fa-lock-open"></i> <span class="d-none d-sm-inline-block">Sign Out</span>
        </a>
    </li>
</ul>