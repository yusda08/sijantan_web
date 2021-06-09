<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('frontend/head'); ?>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-cyan navbar-default navbar-fixed-top">
        <?= $this->include('frontend/nav'); ?>
    </nav>
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content">
            <?php if (isset($ribbon)) { ?>
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"> <?=$ribbon;?></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            <?php } ?>

            <?= $this->include($content); ?>
        </div>
    </div>
    <footer class="main-footer">
        <?= $this->include('frontend/footer'); ?>
    </footer>
</div>

</body>
</html>
