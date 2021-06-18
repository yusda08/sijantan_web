<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;
use Modules\Jalan\Models as Jalan;
use Modules\Utility\Models as Utility;
use Modules\Jalan\Controllers as C_Jalan;

class Data_jalan extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    protected $url = '';
    public function __construct()
    {
        parent::__construct();
        $this->M_Jalan = new Jalan\Model_jalan();
        $this->M_Koordinast = new Jalan\Model_koordinat_jalan();
        $this->M_AssetJalan = new Jalan\Model_asset_jalan();
        $this->M_JalanKondisi = new Jalan\Model_kondisi_jalan();
        $this->M_UtiKondisi = new Utility\Model_kondisi_jalan();
        $this->C_DataJalan = new C_Jalan\Data_jalan();
    }

    function index()
    {
        $record['content'] = $this->module.'\jalan\index';
        $record['ribbon'] = ribbon('Database Jalan');
        $this->frontend($record);
    }

    function detail(){
        $record['content'] = $this->module.'\jalan\detail';
        $record['jalan'] = $this->get('jalan');
        $record['row_jln'] = (array)json_decode($this->C_DataJalan->loadDataJalan($record['jalan']), true);
        $record['getKondisiJalan'] = $this->C_DataJalan->loadKondisiJalan($record['jalan']);
        $record['getPermukaanJalan'] = $this->C_DataJalan->loadPermukaanJalan($record['jalan']);
        $record['getLebarJalan'] = $this->C_DataJalan->loadLebarJalan($record['jalan']);
        $record['getAssetJalan'] = $this->M_AssetJalan->where(['jalan_id' => $record['jalan']])->findAll();
        $record['ribbon'] = ribbon('Database Jalan', 'Detail Jalan');
        $this->frontend($record);
    }

    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $getData = $this->M_Jalan->getResource($search)->orderBy('ruas_no')->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['ruas_no'] = sprintfNumber($row['ruas_no'], 3);
            $getData[$i]['ruas_panjang'] = numberFormat($row['ruas_panjang']);
            $getData[$i]['klasifikasi_nama'] = $row['klasifikasi_nama'] . ' (' . $row['klasifikasi_inisial'] . ')';
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_Jalan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_Jalan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }

    function loadDataKoordinat()
    {
        $jalan_id = $this->get('jalan_id');
        $model = $this->M_Koordinast;
        if($jalan_id){
            $model->where(['jalan_id' => $jalan_id]);
        }
        echo json_encode($model->findAll());
    }

    function loadDataJalan($jalan_id = null)
    {
        $getData = $jalan_id ? $this->M_Jalan->getDataJalan(['jalan_id' => $jalan_id])->getRowArray() : $this->M_Jalan->getDataJalan()->getResultArray();
        return json_encode($getData);
    }

    function loadKondisiJalan($jalan_id = null, $kondisi_id = null)
    {
        $arrayWhere = $jalan_id ? ['jalan_id' => $jalan_id] : '';
        $getData = $kondisi_id ? $this->M_UtiKondisi->where(['kondisi_id' => $kondisi_id])->findAll() : $this->M_UtiKondisi->findAll();
        $getKondisi = $this->M_JalanKondisi->getKondisi($arrayWhere)->getResultArray();
        foreach ($getData as $i => $row_kon) {
            $panjang = 0;
            $ket = '';
            foreach ($getKondisi as $item) {
                if ($item['kondisi_id'] == $row_kon['kondisi_id']) {
                    $panjang += $item['panjang'];
                    $ket = $item['keterangan'];
                }
            }
            $getData[$i]['panjang'] = $panjang;
            $getData[$i]['keterangan'] = $ket;
        }
        $getData = $kondisi_id ? $getData[0] : $getData;
        return json_encode($getData);
    }




}
