<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?= form_open(site_url($moduleUrl . '/add_data'), ['class' => 'form-input-data']); ?>
        <div class="modal-header">
            <h5 class="modal-title label_head">Form Input Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Data Master Jalan</label>
                <div class="col-md-9">
                    <select class="select2 form-control select-jalan" name="jalan" style="width: 100%" required>
                        <option selected disabled value="">.: Pilih Master Jalan :.</option>

                    </select>
                </div>
            </div>
            <?= getCsrf(); ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-simpan"><i class="fa fa-save"></i> Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script>
    $(function () {

        $.getJSON(siteUrl(), function (respon) {

        })

    })
</script>