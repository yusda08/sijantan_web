<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;
use Modules\Jembatan\Models as Jembatan;
use Modules\Utility\Models as Utility;
use Modules\Jalan\Controllers as C_Jalan;

class Data_jembatan extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    protected $url = '';
    public function __construct()
    {
        parent::__construct();
        $this->M_Jembatan = new Jembatan\Model_jembatan();
        $this->tahun = date('Y');
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
//        $record['content'] = $this->module.'\jembatan\detail';
//        $record['jembatan'] = $this->get('jembatan');
//        $record['row_jln'] = (array)json_decode($this->C_DataJalan->loadDataJalan($record['jembatan']), true);
//        $record['getKondisiJalan'] = $this->C_DataJalan->loadKondisiJalan($record['jembatan']);
//        $record['getPermukaanJalan'] = $this->C_DataJalan->loadPermukaanJalan($record['jembatan']);
//        $record['getLebarJalan'] = $this->C_DataJalan->loadLebarJalan($record['jembatan']);
//        $record['getAssetJalan'] = $this->M_AssetJalan->where(['jembatan_id' => $record['jembatan']])->findAll();
//        $record['ribbon'] = ribbon('Database Jalan', 'Detail Jalan');
//        $this->frontend($record);
    }
    
    function loadKondisiJembatan()
    {
        $getData = $this->M_Jembatan->getKondisiJembatan($this->tahun)->getResultArray();
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
