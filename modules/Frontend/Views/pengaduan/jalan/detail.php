<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Detail Pengaduan Jalan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-outline">
                                <div class="card-body">
                                    <ul class="list-group ">
                                        <li class="list-group-item bg-info" style="font-size: 14pt">Kode Tiket
                                            : <?= $row_tiket['tiket_kode']; ?></li>
                                    </ul>
                                    <hr>
                                    <div class="row">
                                        <label class="col-md-4 col-5">Ruas Jalan</label>
                                        <div class="col-md-8 text-justify"><?= $row_tiket['jalan_nama']; ?></div>
                                    </div>
                                    <div class="row ">
                                        <label class="col-md-4 col-7">Tanggal</label>
                                        <div class="col-md-8 text-justify"><?= tgl_indo($row_tiket['pengadu_tgl']); ?></div>
                                    </div>
                                    <div class="row ">
                                        <label class="col-md-4 col-7">Isi Pengaduan</label>
                                        <div class="col-md-8 text-justify"><?= $row_tiket['pengadu_ket']; ?></div>
                                    </div>
                                    <div class="row ">
                                        <label class="col-md-4 col-7">Nama Pengadu</label>
                                        <div class="col-md-8 text-justify"><?= $row_tiket['pengadu_nama']; ?></div>
                                    </div>
                                    <div class="row ">
                                        <label class="col-md-4 col-7">No Telpon</label>
                                        <div class="col-md-8 text-justify"><?= $row_tiket['pengadu_no_hp']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-outline">
                                <div class="card-body">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php
                                            foreach ($getAsset as $i => $asset) { ?>
                                                <div class="carousel-item well_avarage <?= $i == 0 ? 'active' : ''; ?> ">
                                                    <img class="d-block h-100 w-100"
                                                         src="<?= localBase($asset['foto_path'] . $asset['foto_name']); ?>"
                                                         alt="First slide">
                                                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                                                        <h5 class="card-title alert alert-dark text-white"
                                                            style="background: rgb(70, 70, 80, 0.6); font-weight: bold">
                                                            Latitude : <?= $asset['lat']; ?><br>Longitude
                                                            : <?= $asset['long']; ?>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Respon Pengaduan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm tabel_3" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Isi</th>
                                                <th width="15%">Tanggal</th>
                                                <th width="10%">Foto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($getRespon as $i => $row_respon) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $i + 1; ?></td>
                                                    <td><?= $row_respon['respon_ket']; ?></td>
                                                    <td class="text-center"><?= tgl_indo($row_respon['respon_tgl']); ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($row_respon['foto_name']) { ?>
                                                            <a href="<?= base_url($row_respon['foto_path'] . $row_respon['foto_name']); ?>">
                                                                <img height="50px" class="card-img-top"
                                                                     src="<?= base_url($row_respon['foto_path'] . $row_respon['foto_name']); ?>"
                                                                     alt="">
                                                            </a>
                                                        <?php } ?>
                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('frontend/javasc'); ?>
<script>
</script>