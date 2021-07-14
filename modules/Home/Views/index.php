<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="info-box shadow-none bg-info">
                <span class="info-box-icon "><i class="fa fa-road"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Data Jalan</span>
                    <span class="info-box-number">Panjang <span class="panjang-jalan"></span> KM</span>
                    <span class="info-box-number">Ruas <span class="ruas-jalan-total"></span> Titik</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="info-box shadow-none bg-info">
                <span class="info-box-icon "><i class="fa fa-road"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Data Jembatan</span>
                    <span class="info-box-number">Panjang Panjang <span class="panjang-jembatan"> </span> Meter</span>
                    <span class="info-box-number">Jumlah <span class="titik-jembatan-total"></span> Titik</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Grafik Kondisi Jalan
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="kondisi-jalan-chart"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Grafik Kondisi Jembatan
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="kondisi-jembatan-chart"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Data Pengaduan Jalan dan Jembatan
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<?= $this->include('backend/javasc'); ?>
<script>
    $(document).ready(async function () {
        let ttlRuas = 0;
        let panjangRuas = 0;
        const dataJalan = await getDataJalan();
        ttlRuas = dataJalan.length;
        $('.ruas-jalan-total').text(ttlRuas);
        dataJalan.forEach((jln) => {
            panjangRuas += parseInt(jln.ruas_panjang);
        })
        $('.panjang-jalan').text(panjangRuas.toLocaleString());

        let options = {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45,
                    cursor: 'pointer',
                    allowPointSelect: true,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                        distance: -15,
                    }
                }
            },
            title: {
                text: 'Segment Berdasarkan Kondisi'
            },
            subtitle: {
                text: 'Seluruh Kondisi Jalan'
            },
            series: [{
                name: 'Panjang',
                allowPointSelect: true,
                showInLegend: true,
                data: []
            }]
        }
        const dataKonsidi = await getKondisiJalan();
        console.log(dataKonsidi);
        let newseries;
        dataKonsidi.forEach((res) => {
            newseries = {};
            newseries.name = res.kondisi_nama
            newseries.y = parseInt(res.panjang)
            options.series[0].data.push(newseries);
        })
        console.log(options)
        Highcharts.chart('kondisi-jalan-chart', options);
        
        
        let optionsJembatan = {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45,
                    cursor: 'pointer',
                    allowPointSelect: true,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                        distance: -15,
                    }
                }
            },
            title: {
                text: 'Segment Berdasarkan Kondisi'
            },
            subtitle: {
                text: 'Seluruh Kondisi Jembatan'
            },
            series: [{
                name: 'Jumlah',
                allowPointSelect: true,
                showInLegend: true,
                data: []
            }]
        }
        
        const kondisiJembatan = await getKondisiJembatan();
        console.log(kondisiJembatan);
        let chartJembatan;
        kondisiJembatan.forEach((res) => {
            chartJembatan = {};
            chartJembatan.name = res.kondisi_nama;
            chartJembatan.y = parseInt(res.count_kondisi);
            optionsJembatan.series[0].data.push(chartJembatan);
        })
        console.log(options)
        Highcharts.chart('kondisi-jembatan-chart', optionsJembatan);
    });


    async function getKondisiJalan() {
        return await $.getJSON(siteUrl(`jalan/load_kondisi_jalan`))
    }

    async function getDataJalan(jalan_id = null) {
        const url = jalan_id ? `jalan/load_data_jalan/${jalan_id}` : `jalan/load_data_jalan`;
        return await $.getJSON(siteUrl(url))
    }

    async function getJembatan(jembatan_id = null) {
        const url = jembatan_id ? `jembatan/load_data_jembatan/${jembatan_id}` : `jembatan/load_data_jembatan`;
        return await $.getJSON(siteUrl(url));
    }
    
    async function getKondisiJembatan() {
        return await $.getJSON(siteUrl(`jembatan/load_kondisi_jembatan`))
    }
    

</script>