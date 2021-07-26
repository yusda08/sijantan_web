<style>
    .scroll {
        height: 600px;
        overflow-y: scroll;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title">Pengaduan Jalan</h3>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <label class="col-md-1">Filter</label>
                        <div class="col-md-3">
                            <input class="form-control search" name="search" placeholder="Search">
                            <note style="color: red; font-size: 10pt">Note Filter : Nama Jalan dan Pengadu</note>
                        </div>
                    </div>
                    <div class="scroll">
                        <div class="list-pengaduan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('frontend/javasc'); ?>
<script>
    $('.search').keyup(async function (e) {
        e.preventDefault()
        const key = $(this).val();
        loadData(key)
    })

    function htmlPengaduan(res) {
        return `<div class="list-group mb-3">
                                    <a href="${siteUrl(`<?=$moduleUrl;?>/detail?tiket=${res.tiket_kode}`)}" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">${res.jalan_nama}</h5>
                                            <small>${res.pengadu_tgl}</small>
                                        </div>
                                        <p class="mb-1">${res.pengadu_ket}</p>
                                        <small>${res.pengadu_nama}</small>
                                    </a>
                                </div>`;
    }
    async function loadData(paramt = null){
        let getData = await getDataPengaduan(paramt);
        try {
            let htmls = '';
            getData.forEach((res)=> {
                htmls += htmlPengaduan(res);
            })
            $('.list-pengaduan').html(htmls)
        }catch (e) {
            return console.log(e)
        }
    }
    loadData()
    async function getDataPengaduan(paramt =null) {
        return await $.getJSON(siteUrl('<?=$moduleUrl;?>/load_data'), {paramt});
    }
</script>