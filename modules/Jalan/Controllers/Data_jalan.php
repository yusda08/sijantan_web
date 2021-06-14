<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Yusda Helmani
 */

namespace Modules\Jalan\Controllers;

use App\Controllers\BaseController;
use Modules\Jalan\Models as Jalan;

class Data_jalan extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->M_Jalan = new Jalan\Model_jalan();
        $this->M_Koordinast = new Jalan\Model_koordinat_jalan();
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

    function loadDataJalan($jalan_id = null)
    {
        $getJalan = $jalan_id ? $this->M_Jalan->where(['jalan_id' => $jalan_id])->first() : $this->M_Jalan->findAll();
        return $this->respond($getJalan);
    }

    function loadDataKoordinat()
    {
        $jalan_id = $this->get('jalan_id');
        $getJalan = $this->M_Koordinast->where(['jalan_id' => $jalan_id])->findAll();
//        return $this->respond($getJalan);
        echo json_encode($getJalan);
    }

}
