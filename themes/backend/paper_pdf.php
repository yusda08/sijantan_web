<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>View</title>

        <?= js_asset('jquery.min.js', 'bower_components/jquery/dist/'); ?>
        <?= js_asset('bootstrap.min.js', 'bower_components/bootstrap/dist/js/'); ?>

        <?= css_asset('bootstrap.min.css', 'bower_components/bootstrap/dist/css/'); ?>
        <?= css_asset('font-awesome.min.css', 'bower_components/font-awesome/css/'); ?>
        <style type="text/css">
            hr {
                display: block;
                height: 3px;
                border: 0;
                border-top: 1px solid #000000;
                margin: 1em 0;
                padding: 0;
            }
            body{
                font-size: 11pt;
                text-align: left;
            }
            table .main  tr td {
                font-size: 10pt;
                text-align: left;
            }
            table, table .main {
                width: 100%;
                border-collapse: collapse;
                background: #fff;
                text-align: left;

            }
            table tr th{
                padding: 10px;
                border-collapse: collapse;
                text-align: center;
            }

            table tr td{
                vertical-align: top;
                padding: 3px;
            }

            table .padding_8 tr td{
                padding: 8px;
            }
            table .padding_3 tr th{
                padding: 3px;
            }
            table .padding_3 tr td{
                padding: 3px;
            }
            .padding-10{padding:10px}
            .padding-8{padding:8px}
            .padding-5{padding:5px}
            .text-center { text-align: center;}
            .text-right { text-align: right;}
            .border-putus { border-bottom: 1px dotted #666; border-top: 1px dotted #666; }
            .no-border-bottom { border-bottom: 0px ; }
            .no-border-top { border-top: 0px ; }
            .no-border-right { border-right: 0px ; }
            .no-border-left { border-left: 0px ; }
            .border-all { border: 1px solid #666; }
            
            .form-check{
                display:inline-block; 
                position:relative; 
                width:50px; 
                height:25px;
            }
            
            body {
                margin: 0;
                padding: 0;
                font: 11pt "Arial";
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            .page {
                width: 21cm;
                min-height: 29.7cm;
                padding: 1cm;
                margin: 1cm auto;
                border: 1px #D3D3D3 solid;
                border-radius: 1px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
        </style>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>