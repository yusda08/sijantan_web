<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <?= form_open(site_url($moduleUrl . '/update_data'), ['class' => 'form-input-data']); ?>
                    <div class="modal-header">
                        <h5 class="modal-title label_head">Form Update Data</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Nomor Ruas</span>
                                    </div>
                                    <input type="text" class="form-control ruas_no" name="ruas_no" readonly
                                           value="<?= $row_jln['ruas_no']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Nama Jalan</label>
                            <div class="col-md-9">
                                <input class="form-control ruas_nama" name="ruas_nama"
                                       value="<?= $row_jln['ruas_nama']; ?>" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Panjang Jalan</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input class="form-control ruas_panjang" name="ruas_panjang"
                                           value="<?= $row_jln['ruas_panjang']; ?>" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">METER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Nama Pangkal</label>
                            <div class="col-md-9">
                                <input class="form-control ruas_nama_pangkal" name="ruas_nama_pangkal"
                                       value="<?= $row_jln['ruas_nama_pangkal']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Nama Ujung</label>
                            <div class="col-md-9">
                                <input class="form-control ruas_nama_ujung" name="ruas_nama_ujung"
                                       value="<?= $row_jln['ruas_nama_ujung']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Titik Pangkal</label>
                            <div class="col-md-9">
                                <input class="form-control ruas_titik_pangkal" name="ruas_titik_pangkal"
                                       value="<?= $row_jln['ruas_titik_pangkal']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Titik Ujung</label>
                            <div class="col-md-9">
                                <input class="form-control ruas_titik_ujung" name="ruas_titik_ujung"
                                       value="<?= $row_jln['ruas_titik_ujung']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Klasifikasi</label>
                            <div class="col-md-9">
                                <select class="select2 form-control select-klasifikasi" name="klasifikasi_id"
                                        style="width: 100%"
                                        required>
                                    <option selected disabled value="">.: Pilih Klasifikasi :.</option>
                                    <?php
                                    foreach ($getKlasifikasi as $row_klas) {
                                        $attrKlas = $row_klas['klasifikasi_id'] == $row_jln['klasifikasi_id'] ? 'selected' : '';
                                        echo "<option $attrKlas value='{$row_klas['klasifikasi_id']}'>{$row_klas['klasifikasi_nama']} ({$row_klas['klasifikasi_inisial']})</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Status Jalan</label>
                            <div class="col-md-9">
                                <input class="form-control ruas_status" name="ruas_status"
                                       value="<?= $row_jln['ruas_status']; ?>" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 col-form-label">Kecamatan</label>
                            <div class="col-md-9">
                                <select class="select2 form-control select-kecamatan" multiple name="kecamatan[]"
                                        style="width: 100%"
                                        required>
                                    <?php
                                    $dtKec = explode(',', $row_jln['kecamatan']);
                                    foreach ($getKecamatan as $row_kec) {
                                        $attrKec = '';
                                        foreach ($dtKec as $item) {
                                            if ($row_kec['kec_nama'] == $item) {
                                                $attrKec = 'selected';
                                            }
                                        }
                                        echo "<option $attrKec value='{$row_kec['kec_nama']}'>{$row_kec['kec_nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control jalan_id" name="jalan_id" value="<?=$jalan;?>">
                        <?= getCsrf(); ?>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div class="col-md-2">
                            <a href="<?= site_url('jalan/detail?jalan=' . $jalan); ?>" class="btn btn-block btn-danger"><i
                                        class="fa fa-backward"></i> Kembali</a>
                        </div>
                        <div class="col-md-2">

                            <button type="submit" class="btn btn-success btn-block btn-simpan"><i class="fa fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
<script>

</script>