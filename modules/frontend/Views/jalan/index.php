<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-6">
            <div class="info-box shadow-none bg-info">
                <span class="info-box-icon "><i class="fa fa-road"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Panjang Jalan</span>
                    <span class="info-box-number">0 KM</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="info-box shadow-none bg-info">
                <span class="info-box-icon "><i class="fa fa-road"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jaringan Jalan</span>
                    <span class="info-box-number">0 Ruas</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Database Jalan</h3>
                </div>
                <div class="card-body">
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
<?= $this->include('frontend/javasc'); ?>
<script>$('.tabel-server-side').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        paging: true,
        info: true,
        pageLength: 25,
        responsive: true,
        lengthChange: true,
        scrollCollapse: false,
        deferRender: true,
        ajax: {
            url: siteUrl('frontend/jalan/load_data_table'),
            type: "POST",
            data: {},
        },
        columns: [// Tampilkan nis
            {data: "ruas_no"},
            {"data": function (row) { // Tampilkan kolom aksi
                    return `<a href="${siteUrl(`frontend/jalan/detail?jalan=${row.jalan_id}`)}" class="btn btn-link btn-sm">${row.ruas_nama}</a>`;
                }
            },
            {data: "ruas_status"},
            {data: "klasifikasi_nama"},
            {data: "kecamatan"},
            {data: "ruas_panjang"},
            {data: "ruas_nama_pangkal"},
            {data: "ruas_nama_ujung"},
            {data: "ruas_titik_pangkal"},
            {data: "ruas_titik_ujung"},
        ],
        columnDefs: [
            {className: "text-center", targets: [0, 5]},
        ]
    });

</script>