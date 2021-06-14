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
                        <table class="table table-sm table-hover table-bordered tabel-server-side" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">No Ruas</th>
                                <th>Nama Ruas</th>
                                <th>Status Jalan</th>
                                <th>Klasifikasi Jalan</th>
                                <th>Kecamatan</th>
                                <th>Ruas Panjang <br>(Meter)</th>
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
        $('.tabel-server-side').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            scrollY: '50vh',
            scrollX: true,
            paging: false,
            info: true,
            lengthChange: false,
            scrollCollapse: false,
            deferRender: true,
            ajax: {
                url: siteUrl('jalan/load_data_table'),
                type: "POST",
                data: {},
            },
            columns: [// Tampilkan nis
                {data: "ruas_no"},
                {data: "ruas_nama"},
                {data: "ruas_status"},
                {data: "klasifikasi_nama"},
                {data: "kecamatan"},
                {data: "ruas_panjang"},
                {data: "ruas_nama_pangkal"},
                {data: "ruas_nama_ujung"},
                {data: "ruas_titik_pangkal"},
                {data: "ruas_titik_ujung"},
                {
                    "render": function (data, type, row) { // Tampilkan kolom aksi
                        return `<a href="${siteUrl(`jalan/detail?jalan=${row.jalan_id}`)}" class="btn btn-primary btn-block btn-sm"><i class="fa fa-search"><i>  Detail</a>`;
                    }
                }
            ],
            columnDefs: [
                {className: "text-center", targets: [0, 5]},
            ]
        });
</script>