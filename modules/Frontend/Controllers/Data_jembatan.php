<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;
use Modules\Jembatan\Models as Jembatan;
use Modules\Utility\Models as Utility;
use Modules\Jembatan\Controllers as C_Jembatan;

class Data_jembatan extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    protected $url = '';
    public function __construct()
    {
        parent::__construct();
        $this->M_Jembatan = new Jembatan\Model_jembatan();
        $this->M_AssetJembatan = new Jembatan\Model_asset_jembatan();
        $this->tahun = date('Y');
        $this->C_DataJembatan = new C_Jembatan\Data_jembatan();
    }

    function index()
    {
        $record['content'] = $this->module.'\jembatan\index';
        $record['ribbon'] = ribbon('Database Jembatan');
        $this->frontend($record);
    }
    
    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $getData = $this->M_Jembatan->getResource($search)->orderBy('nomor')->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['nomor'] = sprintfNumber($row['nomor'], 3);
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_Jembatan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_Jembatan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }

    function detail(){
        $record['content'] = $this->module.'\jembatan\detail';
        $record['jembatan'] = $this->get('jembatan');
        $record['row_jembatan'] = json_decode($this->C_DataJembatan->loadDataJembatan($record['jembatan']), true);
        $record['getTipeKondisiJembatan'] = json_decode($this->C_DataJembatan->loadTipeKondisiJembatan($record['jembatan']), true);
        $record['rowSpesifikasiJembatan'] = json_decode($this->C_DataJembatan->loadSpesifikasiJembatan($record['jembatan']), true);
        $record['getAssetJembatan'] = $this->M_AssetJembatan->where(['jembatan_id' => $record['jembatan']])->findAll();
        $record['ribbon'] = ribbon('Database Jembatan', 'Detail Jembatan');
        $this->frontend($record);
    }
    
    function loadKondisiJembatan()
    {
        $getData = $this->M_Jembatan->getKondisiJembatan($this->tahun)->getResultArray();
        return json_encode($getData);
    }
    function loadKategoriJembatan()
    {
        $getData = $this->M_Jembatan->getKategoriJembatan($this->tahun)->getResultArray();
        return json_encode($getData);
    }

    function loadDataJembatan($jembatan_id = null)
    {
        $getData = $jembatan_id ? $this->M_Jembatan->getDataJembatan(['a.jembatan_id' => $jembatan_id, 'tahun' => $this->tahun])->getRowArray() : $this->M_Jembatan->getDataJembatan()->getResultArray();
        return json_encode($getData);
    }
    
    function loadSpesifikasiJembatan($jembatan_id = null){
        $getData = $jembatan_id ? $this->M_Jembatan->getSpesifikasiJembatan(['a.jembatan_id' => $jembatan_id, 'tahun'=> $this->tahun])->getRowArray() : $this->M_Jembatan->getSpesifikasiJembatan()->getResult();
        return json_encode($getData);
    }
    function loadTipeKondisiJembatan($jembatan_id = null){
        $getData = $jembatan_id ? $this->M_Jembatan->getTipeKondisiJembatan(['a.jembatan_id' => $jembatan_id, 'tahun'=> $this->tahun])->getResultArray() : $this->M_Jembatan->getTipeKondisiJembatan()->getResultArray();
        return json_encode($getData);
    }
}
