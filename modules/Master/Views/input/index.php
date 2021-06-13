<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Database Jalan</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?php
                        echo form_open($moduleUrl . '/form_add', ['class' => 'form-add-jalan', 'method' => 'GET']);
                        echo btnAction('add', '', 'Data Jalan', '');
                        echo form_close();
                        ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel_2" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">No Ruas</th>
                                <th>Nama Ruas</th>
                                <th>Status Jalan</th>
                                <th>Klasifikasi Jalan</th>
                                <th>Kecamatan</th>
                                <th>Ruas Panjang</th>
                                <th>Nama Ruas Pangkal</th>
                                <th>Nama Ruas Ujung</th>
                                <th>Titik Ruas Pangkal</th>
                                <th>Titik Ruas Ujung</th>
                                <th width="8%"><i class="fa fa-cog"></i></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('backend/javasc'); ?>
<script>

</script>