<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Si-Jantan</title>
<link rel="icon" type="image/png" sizes="56x56" href="<?= logoKab(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<?= css_asset('all.min.css', 'plugins/fontawesome-free/css/'); ?>
<?= css_asset('adminlte.min.css', 'dist/css/'); ?>
<?= css_asset('OverlayScrollbars.min.css', 'plugins/overlayScrollbars/css/'); ?>
<?= css_asset('daterangepicker.css', 'plugins/daterangepicker/'); ?>
<?= css_asset('summernote-bs4.css', 'plugins/summernote/'); ?>
<?= css_asset('select2-bootstrap4.min.css', 'plugins/select2-bootstrap4-theme/'); ?>
<?= css_asset('select2.min.css', 'plugins/select2/css/'); ?>
<?= css_asset('sweetalert2.min.css', 'plugins/sweetalert/dist/'); ?>
<?= css_asset('icheck-bootstrap.min.css', 'plugins/icheck-bootstrap/'); ?>
<?= css_asset('croppie.css', 'plugins/crop/'); ?>
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
<link href='https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css' rel='stylesheet' />
<style>
    /*@import url(https://fonts.googleapis.com/css?family=Quicksand);*/
    html {
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }


    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none;
    }

    #main #content {
        height: 100%;
    }

    .hidden {
        display: none;
    }

    .logo-img {
        /*float: left;*/
        width: 100px;

        padding: 10px;
        background: #ff0000;
        border-radius: 10px;

    }

    .my-custom-scrollbar {
        position: relative;
        height: 560px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    /*.smart-style-3 .btn-header>:first-child>a{background:#1264ed;border:1px solid #fff;color:#fff!important;cursor:pointer!important}*/
    select.select2 {
        position: static !important;
        outline: none !important;
    }

    #main {
        background-image: url('<?php echo base_url(); ?>assets/img/mybg.png') !important;
        background-size: auto;
        -webkit-background-size: 100% 100%;
        /*background-repeat : no-repeat;*/
        background-attachment: fixed;
        min-height: calc(100vh - 5em);
        overflow: auto;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .form-check {
        display: inline-block;
        position: relative;
        width: 40px;
        height: 20px;
    }

    .form-radio {
        display: inline-block;
        position: relative;
        width: 30px;
        height: 20px;
    }

    .ajax-loader {
        align-content: center;
        visibility: hidden;
        position: absolute;
        z-index: +100 !important;
        width: 100%;
        height: 100%;
    }

    .ajax-loader img {
        position: relative;
    }

    .ajax-loader-modal {
        align-content: center;
        visibility: hidden;
        position: absolute;
        z-index: +100 !important;
        width: 100%;
        height: 100%;
    }

    .ajax-loader-modal img {
        position: relative;
    }

    #notiv {
        width: 40%;
        position: absolute;
        z-index: 999;
    }

    #notivs {
        width: 100%;
        float: right;
        position: absolute;
        z-index: 1;
        top: 10px;
    }

    .inputHover {
        background-color: #ffffcc;
        border: solid 2px;
        border-color: #000;
    }

    .table thead tr th {
        text-align: center;
        vertical-align: top;
        background-color: #A6A4A4;
        color: #000;
        font-weight: bold;
    }

    note {
        font-size: 8pt;
    }

    .table tfoot tr th {
        vertical-align: top;
        background-color: #dedede;
        color: #000;
        font-weight: bold;
    }

    .table tbody tr td {
        vertical-align: top;
        color: #000;
        font-size: 10pt
    }


    .modal-header {
        background-color: #343a40 !important;
        color: #FFFFFF;
    }

    .modal-footer {
        background-color: #343a40 !important;
        color: #FFFFFF;
    }


    /*    td
    {
        font-size: 10pt;
    }*/
    /*    .table{
            border: 1px solid;
        }*/
    /*.active {background-color:#ededed};*/

    body {
        font-family: Arial;
        color: #000000;
    }

    .card-header {
        color: #fff
    }.card-header {
        background: #343a40 linear-gradient(180deg, #52585d, #343a40) repeat-x !important
    }

    #myBtn {
        /*display: none;*/
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        /*background-color: red;*/
        color: white;
        cursor: pointer;
        padding: 10px;
        border-radius: 4px;
    }

    #myBtn:hover {
        background-color: #555;
    }

    #myBtnTrn {
        /*display: none;*/
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        color: white;
        cursor: pointer;
        padding: 10px;
        border-radius: 0px;
    }

    #myBtnTrn:hover {
        background-color: #555;
    }

    #map{
        min-height: 600px;
    }
</style>