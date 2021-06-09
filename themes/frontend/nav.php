<div class="container">
    <a href="<?=base_url('/');?>" class="navbar-brand">
        <img src="<?=logoKab();?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>Si-Jantan</strong></span>
    </a>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="<?=base_url('/');?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item">Some action </a></li>
                    <li><a href="#" class="dropdown-item">Some other action</a></li>

                    <li class="dropdown-divider"></li>

                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                            <li>
                                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                            </li>
                            <li class="dropdown-submenu">
                                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="dropdown-item">level 2</a></li>
                            <li><a href="#" class="dropdown-item">level 2</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-danger" href="<?=site_url('login');?>">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
            </li>
        </ul>
</div>