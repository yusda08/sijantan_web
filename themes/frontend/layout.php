<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('frontend/head'); ?>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav ">
<div class="wrapper">
    <nav id="navbar_top"  class="main-header  fixed-top navbar navbar-expand-md navbar-light navbar-cyan ">
        <?= $this->include('frontend/nav'); ?>
    </nav>
    <div class="content-wrapper pt-5">
        <!-- Content Header (Page header) -->
        <div class="content">
            <?php if (isset($ribbon)) { ?>
                <div class="content-header pt-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="m-0"> <?=$ribbon;?></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            <?php } ?>
        </div>
        <?= $this->include($content); ?>
    </div>
</div>
<footer class="main-footer">
    <?= $this->include('frontend/footer'); ?>
</footer>
</body>
</html>
