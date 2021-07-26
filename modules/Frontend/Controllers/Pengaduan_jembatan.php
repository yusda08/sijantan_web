<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\Pengaduan\Models as MPengaduan;

class Pengaduan_jembatan extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    protected $moduleUrl = 'frontend/pengaduan/jembatan';
    public function __construct()
    {
        parent::__construct();
        $this->M_PJembatan = new MPengaduan\Model_pengaduan_jembatan();
        $this->M_PResponJembatan = new MPengaduan\Model_pengaduan_respon_jembatan();
        $this->M_PAssetJembatan = new MPengaduan\Model_pengaduan_asset_jembatan();
    }

    function index()
    {
        $record['moduleUrl'] = $this->moduleUrl;
        $record['content'] = $this->module.'\pengaduan\jembatan\index';
        $record['ribbon'] = ribbon('Data Pengaduan Jembatan');
        $this->frontend($record);
    }

    function detail(){
        $record['content'] = $this->module.'\pengaduan\jembatan\detail';
        $record['tiket'] = $this->get('tiket');
        $record['row_tiket'] = $this->M_PJembatan->getPengaduanJembatan(['tiket_kode' => $record['tiket']])->getRowArray();
        $record['getRespon'] = $this->M_PResponJembatan->where(['tiket_kode' => $record['tiket']])->findAll();
        $record['getAsset'] = $this->M_PAssetJembatan->where(['tiket_kode' => $record['tiket']])->findAll();
        $record['ribbon'] = ribbon('Detail Pengaduan Jembatan');
        $this->frontend($record);
    }

     function loadData(){
         $search = $this->get('paramt');
         $getData = $this->M_PJembatan->getResource($search, ['status_respon' => 1])->orderBy('pengadu_tgl')->get()->getResultArray();
         foreach ($getData as $i => $row) {
             $getData[$i]['pengadu_tgl'] = tgl_indo($row['pengadu_tgl']);
         }
         return $this->respond($getData);
     }


    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $dir = $this->request->getPost('order[0][dir]');
        $getData = $this->M_PJembatan->getResource($search, ['status_respon' => 1])->orderBy('pengadu_tgl')->limit($length, $start)->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['pengadu_tgl'] = tgl_indo_angka($row['pengadu_tgl']);
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_PJembatan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_PJembatan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }

}
