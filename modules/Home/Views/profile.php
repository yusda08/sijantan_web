<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <?= form_open(site_url('home/forget_password'), ['class' => 'form-forget']);?>
                <div class="card-header">
                    Form Update Profile
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <label class="col-md-3">Username</label>
                        <div class="col-md-9">
                            <input readonly class="form-control username" name="username" value="<?=$log['username'];?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3">Password Baru</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="kd_user" value="<?=$log['kd_user'];?>">
                    <?= getCsrf();?>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <?= form_close();?>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script>

</script>