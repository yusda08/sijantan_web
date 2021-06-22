<?php

namespace Modules\Pengaduan\Controllers;

use App\Controllers\BaseController;
use Modules\Pengaduan\Models as Pengaduan;

class Pengaduan_jalan extends BaseController
{
    private $module = 'Modules\Pengaduan\Views', $moduleUrl = 'pengaduan/jalan';

    public function __construct()
    {
        parent::__construct();
        $this->M_PJalan = new Pengaduan\Model_pengaduan_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jalan\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('Pengaduan', 'Jalan');
        $this->render($record);
    }

    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $dir = $this->request->getPost('order[0][dir]');
        $getData = $this->M_PJalan->getResource($search)->orderBy('pengadu_tgl')->limit($length, $start)->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['ruas_nama'] = sprintfNumber($row['ruas_no'], 3).' - '.$row['ruas_nama'];
            $getData[$i]['pengadu_tgl'] = tgl_indo($row['pengadu_tgl']);
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_PJalan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_PJalan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }


}
