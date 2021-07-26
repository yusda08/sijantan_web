<?php
namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\Pengaduan\Models as MPengaduan;

class Pengaduan_jalan extends BaseController
{

    protected $module = 'Modules\Frontend\Views';
    protected $moduleUrl = 'frontend/pengaduan/jalan';
    public function __construct()
    {
        parent::__construct();
        $this->M_PJalan = new MPengaduan\Model_pengaduan_jalan();
        $this->M_PResponJalan = new MPengaduan\Model_pengaduan_respon_jalan();
        $this->M_PAssetJalan = new MPengaduan\Model_pengaduan_asset_jalan();
    }

    function index()
    {
        $record['moduleUrl'] = $this->moduleUrl;
        $record['content'] = $this->module.'\pengaduan\jalan\index';
        $record['ribbon'] = ribbon('Data Pengaduan Jalan');
        $this->frontend($record);
    }

    function detail(){
        $record['content'] = $this->module.'\pengaduan\detail';
        $record['tiket'] = $this->get('tiket');
        $record['ribbon'] = ribbon('Detail Pengaduan Jalan');
        $this->frontend($record);
    }


    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $dir = $this->request->getPost('order[0][dir]');
        $getData = $this->M_PJalan->getResource($search, ['status_respon' => 1])->orderBy('pengadu_tgl')->limit($length, $start)->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['pengadu_tgl'] = tgl_indo_angka($row['pengadu_tgl']);
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_PJalan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_PJalan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }

}
