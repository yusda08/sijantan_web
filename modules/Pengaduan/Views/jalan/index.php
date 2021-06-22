<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Pengaduan Jalan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel-server-side" width='100%'>
                            <thead>
                            <tr>
                                <th width="8%">Tiket</th>
                                <th>Nama Ruas</th>
                                <th>Isi Pengaduan</th>
                                <th>Nama Pengadu</th>
                                <th>No Telpon</th>
                                <th>Tanggal</th>
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
        paging: true,
        info: true,
        pageLength: 25,
        responsive: true,
        lengthChange: true,
        scrollCollapse: false,
        deferRender: true,
        ajax: {
            url: siteUrl('<?=$moduleUrl?>/load_data_table'),
            type: "POST"
        },
        columns: [// Tampilkan nis
            {data: "tiket_kode"},
            {data: "ruas_nama"},
            {data: "pengadu_ket"},
            {data: "pengadu_nama"},
            {data: "pengadu_no_hp"},
            {data: "pengadu_tgl"},
            {
                "render": function (data, type, row) {
                    return `<a href="${siteUrl(`<?=$moduleUrl;?>/detail?tiket=${row.tiket_kode}`)}" class="btn btn-primary btn-block btn-xs"><i class="fa fa-search"><i>  Detail</a>`;
                }
            }
        ],
        columnDefs: [
            {className: "text-center", targets: [0, 5]},
        ]
    });
</script>