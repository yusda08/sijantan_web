<?php
$status = $get_row['status'];
if($get_row['status'] == true){
    $alert = 'success';
    $icon = 'check';
}else{
    $alert = 'danger';
    $icon = 'close';
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info card-outline">
                <div class="card-body text-center">
                    <h3 class="title-status alert alert-<?= $alert; ?> "><?= $get_row['ket']; ?>
                    <br>
                        <i class="fa fa-<?= $icon; ?> fa-lg"></i>
                    </h3>
                    <a href="<?= site_url('/'); ?>" class="btn btn-danger"><i class="fa fa-backward"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
<?= $this->include('frontend/javasc'); ?>
<script>
    // $(document).ready(function () {
        // $('.title-status').text('Berhasil').addClass('alert alert-success');
    // })
</script>
