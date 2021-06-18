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
                    <select class="select2 form-control select-jalan" name="jalan" style="width: 100%">
                        <option selected disabled value="">.: Pilih Master Jalan :.</option>

                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label"></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nomor Ruas</span>
                        </div>
                        <input type="text" class="form-control ruas_no" name="ruas_no" required>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Nama Jalan</label>
                <div class="col-md-9">
                    <input class="form-control ruas_nama" name="ruas_nama" required>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Panjang Jalan</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input class="form-control ruas_panjang" name="ruas_panjang" required>
                        <div class="input-group-append">
                            <span class="input-group-text">METER</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Nama Pangkal</label>
                <div class="col-md-9">
                    <input class="form-control ruas_nama_pangkal" name="ruas_nama_pangkal">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Nama Ujung</label>
                <div class="col-md-9">
                    <input class="form-control ruas_nama_ujung" name="ruas_nama_ujung">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Titik Pangkal</label>
                <div class="col-md-9">
                    <input class="form-control ruas_titik_pangkal" name="ruas_titik_pangkal">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Titik Ujung</label>
                <div class="col-md-9">
                    <input class="form-control ruas_titik_ujung" name="ruas_titik_ujung">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Klasifikasi</label>
                <div class="col-md-9">
                    <select class="select2 form-control select-klasifikasi" name="klasifikasi_id" style="width: 100%"
                            required>
                        <option selected disabled value="">.: Pilih Klasifikasi :.</option>
                        <?php
                        foreach ($getKlasifikasi as $row_klas) {
                            echo "<option value='{$row_klas['klasifikasi_id']}'>{$row_klas['klasifikasi_nama']} ({$row_klas['klasifikasi_inisial']})</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Status Jalan</label>
                <div class="col-md-9">
                    <input class="form-control ruas_status" name="ruas_status" required>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Kecamatan</label>
                <div class="col-md-9">
                    <select class="select2 form-control select-kecamatan" multiple name="kecamatan[]"
                            style="width: 100%"
                            required>
                        <?php
                        foreach ($getKecamatan as $row_kec) {
                            echo "<option value='{$row_kec['kec_nama']}'>{$row_kec['kec_nama']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3 col-form-label">Koordinat</label>
                <div class="col-md-9">
                    <textarea class="form-control koordinat" rows="5" name="koordinat" required></textarea>
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
    $('.form-input-data').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
            beforeSend: () => {
                $('.btn-simpan').html(`<i class="fa fa-spin fa-spinner"></i> Loading . . .`)
                $('.btn-simpan').prop('disabled', true)
            },
            complete: () => {
                $('.btn-simpan').html(`<i class="fa fa-power-off"></i>  &nbsp; Posting`)
                $('.btn-simpan').prop('disabled', false)
            },
            success: (res) => {
                notifSmartAlert(res.status, res.ket)
                if(res.status == true){
                    location.href = siteUrl(`jalan/input_data`);
                }
            },
            error: function (request, status, error) {
                notifSmartAlert(false, request.responseText);
            }
        })
    })
    $(async function () {
        const dataJalan = await getDataJalan();
        const dataJson = await getJsonKoordinat();
        let htmls = '';
        dataJson.forEach((res) => {
            const properties = res.properties;
            let attrJln = '';
            dataJalan.forEach((jln) => {
                if (jln.ruas_no == properties.No) {
                    attrJln = 'disabled';
                }
            })
            htmls += `<option ${attrJln} data-id='${res.id}'
                                data-no='${properties.No}'
                                data-panjang='${properties.Kon_Mntp}'
                                data-titik_pangkal='${properties.Ttk_Ruas_1}'
                                data-titik_ujung='${properties.Ttk_Ruas_A}'
                                data-status='${properties.Status}'
                                data-kecamatan='${properties.Kecamatan}'
                                data-nama='${properties.Nm_Ruas}'>${properties.NAME}</option>`;
        })
        $('.select-jalan').append(htmls)
    })

    $('.select-jalan').change(async function (e) {
        console.log($(this).find('option:selected').data('kecamatan'))
        $('.ruas_nama').val($(this).find('option:selected').data('nama'));
        $('.ruas_no').val($(this).find('option:selected').data('no'));
        $('.ruas_panjang').val($(this).find('option:selected').data('panjang'));
        $('.ruas_titik_pangkal').val($(this).find('option:selected').data('titik_pangkal'));
        $('.ruas_titik_ujung').val($(this).find('option:selected').data('titik_ujung'));
        $('.ruas_status').val($(this).find('option:selected').data('status'));
        $('.select-kecamatan').val($(this).find('option:selected').data('kecamatan')).change();
        const id = $(this).find('option:selected').data('id');
        const dataJson = await getJsonKoordinat();
        dataJson.forEach((res) => {
            if (id == res.id) {
                $('.koordinat').text(JSON.stringify(res.coordinates));
            }
        })
    })

    async function getDataJalan() {
        return await $.getJSON(siteUrl(`jalan/load_data_jalan`))
    }

    async function getJsonKoordinat() {
        return await $.getJSON(siteUrl('master/koordinat/load_json_koordinat'))
    }


</script>