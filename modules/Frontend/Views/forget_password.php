<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info card-outline">
                <?= form_open(site_url('frontend/home/update_password'), ['class' => 'form-forget-password']); ?>
                <div class="card-header">
                    Form Forget Password
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <label class="col-md-3">Username</label>
                        <div class="col-md-9">
                            <input type="text" readonly class="form-control" name="username" value="<?= $username; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3">Password Baru</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password_new">
                        </div>
                    </div>
                </div>
                <div class="card-footer row justify-content-end">
                    <div class="col-auto">
                        <button class="btn btn-success btn-save"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
<?= $this->include('frontend/javasc'); ?>
<script>
    $('.form-forget-password').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
            beforeSend: () => {
                $('.btn-save').html(`<i class="fa fa-spin fa-spinner"></i> Loading . . .`)
                $('.btn-save').prop('disabled', true)
            },
            complete: () => {
                $('.btn-save').html(`<i class="fa fa-save"></i>  &nbsp; Simpan`)
                $('.btn-save').prop('disabled', false)
            },
            success: (res) => {
                notifSmartAlert(res.status, res.ket)
                if (res.status == true) {
                    setTimeout(function(){
                        // console.log(res)
                            location.href = siteUrl('/')
                        }, 2000)
                }
            },
            error: function (request, status, error) {
                notifSmartAlert(false, request.responseText);
            }
        })
        return false;
    })
</script>
