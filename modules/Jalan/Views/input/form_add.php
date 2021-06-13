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
            <div class="row form-group">
                <label class="col-md-3 col-form-label"></label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nomor Ruas</span>
                        </div>
                        <input type="text" class="form-control ruas_no">
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Nama Jalan</label>
                <div class="col-md-9">
                    <input class="form-control ruas_nama" name="ruas_nama">
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
        $.getJSON(siteUrl('master/koordinat/load_json_koordinat'), function (respon) {
            let htmls = '';
            respon.forEach((res) => {
                const properties = res.properties;
                // console.log(JSON.stringify(res.coordinates))
                // console.log(properties);
                htmls += `<option data-id='${res.id}'
                                data-no='${properties.No}'
                                data-panjang='${properties.Kon_Mntp}'
                                data-titik_pangkal='${properties.Ttk_Ruas_1}'
                                data-titik_ujung='${properties.Ttk_Ruas_A}'
                                data-nama='${properties.Nm_Ruas}'>${properties.NAME}</option>`;
            })
            $('.select-jalan').append(htmls)
        })
    })

    $('.select-jalan').change(function () {
        $('.ruas_nama').val($(this).find('option:selected').data('nama'));
        $('.ruas_no').val($(this).find('option:selected').data('no'));
        const id = $(this).find('option:selected').data('id');
        $.getJSON(siteUrl('master/koordinat/load_json_koordinat'), function (respon) {
            respon.forEach((res) => {
                if(id == res.id){
                    console.log(JSON.stringify(res.coordinates))
                }
            })
        })
    })


</script>