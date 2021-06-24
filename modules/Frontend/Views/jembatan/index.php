<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-6">
            <div class="info-box shadow-none bg-info">
                <span class="info-box-icon "><i class="fa fa-reorder"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Panjang Jembatan</span>
                    <span class="info-box-number"><span class="panjang-jembatan"></span> Meter</span>
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
                    <h3 class="card-title">Database Jembatan</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center kondisi-jembatan"></div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered tabel-server-side" width='100%'>
                            <thead>
                            <tr>
                                <th width="5%">Nomor Jembatan</th>
                                <th>Nama Jembatan</th>
                                <th>Nama Ruas</th>
                                <th>Panjang Jembatan<br> (meter)</th>
                                <th>Lebar Jembatan<br> (meter)</th>
                                <th>STA</th>
                                <th>Jumlah Bentang</th>
                                <th>Kecamatan</th>
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
<script>
    $(document).ready(async function () {
        const dataJembatan = await getDataJembatan();
        const kondisiJembatan = await getKondisiJembatan();

        kondisiJembatan.forEach((res) => {
            $('.kondisi-jembatan').append(renderKondisi(res))
        })

        $('.ruas-jembatan-total').text(dataJembatan.length);
        let panjangRuas = 0;
        dataJembatan.forEach((jbtn) => {
            panjangRuas += parseInt(jbtn.panjang);
        })
        $('.panjang-jembatan').text(panjangRuas.toLocaleString());
    })

    function renderKondisi(res) {
        let color = 'bg-green';
        if(res.kondisi_id == 2){
            color = 'bg-warning'
        }else if(res.kondisi_id == 3){
            color = 'bg-danger'
        }else if(res.kondisi_id == 4){
            color = 'bg-dark'
        }
        return `<div class="col-md-2 col-6">
    <div class="info-box shadow-none ${color}">
        <span class="info-box-icon "><i class="fa fa-reorder"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">${res.kondisi_nama}</span>
            <span class="info-box-number">${res.count_kondisi.toLocaleString()} Jembatan</span>
        </div>
    </div>
</div>`
    }

    async function getDataJembatan(jembatan_id = null) {
        const url = jembatan_id ? `frontend/jembatan/load_data_jembatan/${jembatan_id}` : `frontend/jembatan/load_data_jembatan`;
        return await $.getJSON(siteUrl(url))
    }

    async function getKondisiJembatan() {
        return await $.getJSON(siteUrl(`frontend/jembatan/load_kondisi_jembatan`))
    }

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
            url: siteUrl('frontend/jembatan/load_data_table'),
            type: "POST",
            data: {},
        },
        columns: [// Tampilkan nis
            {data: "nomor"},
            {
                "data": function (row) { // Tampilkan kolom aksi
                    return `<a href="${siteUrl(`frontend/jembatan/detail?jembatan=${row.jembatan_id}`)}" class="btn btn-link btn-sm">${row.nama}</a>`;
                }
            },
            {data: "ruas"},
            {data: "panjang"},
            {data: "lebar"},
            {data: "sta"},
            {data: "jumlah_bentang"},
            {data: "kecamatan"},
        ],
        columnDefs: [
            {className: "text-center", targets: [0, 5]},
        ]
    });

</script>