<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Si-Jantan</title>
<link rel="icon" type="image/png" sizes="56x56" href="<?= logoKab(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<?= css_asset('all.min.css', 'plugins/fontawesome-free/css/'); ?>
<?= css_asset('adminlte.min.css', 'dist/css/'); ?>
<?= css_asset('bs-stepper.min.css', 'plugins/bs-stepper/css/'); ?>
<?= css_asset('sweetalert2.min.css', 'plugins/sweetalert/dist/'); ?>
<style>
    nav.navbar{
        border: 1px solid;
        font-weight: bold;
    }
    nav.navbar ul li a{
        /*border: 1px solid;*/
        color: #000000;
    }
    nav.navbar ul li.nav-item a:hover{
        background-color: #ffffff;
    }

    .wrapper{
        min-height:100%;
        position:relative;
    }

    .card-header {
        color: #fff
    }.card-header {
         background: #343a40 linear-gradient(180deg, #52585d, #343a40) repeat-x !important
     }
    .table thead tr th {
        text-align: center;
        vertical-align: top;
        background-color: #A6A4A4;
        color: #000;
        font-weight: bold;
    }
    #map {
        min-height: 600px;
    }
</style>
