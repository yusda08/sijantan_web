<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline">
                <div class="card-header">
                    Form Profile Unit
                </div>
                <?= form_open($moduleUrl . '/add_data', ['class' => 'form-profile']) ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3">Alamat</label>
                        <div class="col-md-9">
                        <textarea
                                class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?> alamat"
                                placeholder="Alamat" name="alamat"><?= $row_unit['alamat']; ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">No Telpon</label>
                        <div class="col-md-9">
                            <input class="form-control <?= ($validation->hasError('no_telpon')) ? 'is-invalid' : ''; ?> no_telpon"
                                   placeholder="No Telpon" name="no_telpon" value="<?= $row_unit['no_telpon']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_telpon'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Email</label>
                        <div class="col-md-9">
                            <input class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?> email"
                                   placeholder="Email" name="email" value="<?= $row_unit['email']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3">Link Facebook</label>
                            <div class="col-md-9">
                                <input class="form-control <?= ($validation->hasError('link_fb')) ? 'is-invalid' : ''; ?> link_fb"
                                       placeholder="Link Facebook" name="link_fb" value="<?= $row_unit['link_fb']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('link_fb'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Link Instagram</label>
                        <div class="col-md-9">
                            <input class="form-control <?= ($validation->hasError('link_instagram')) ? 'is-invalid' : ''; ?> link_instagram"
                                   placeholder="Link Instagram" name="link_instagram"
                                   value="<?= $row_unit['link_instagram']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('link_instagram'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Link Youtube</label>
                        <div class="col-md-9">
                            <input class="form-control <?= ($validation->hasError('link_youtube')) ? 'is-invalid' : ''; ?> link_youtube"
                                   placeholder="Link Instagram" name="link_youtube"
                                   value="<?= $row_unit['link_youtube']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('link_youtube'); ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control id" name="id" value="<?= $row_unit['id']; ?>">
                    <?= getCsrf(); ?>
                </div>
                <div class="card-footer row justify-content-end">
                    <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->include('backend/javasc'); ?>
