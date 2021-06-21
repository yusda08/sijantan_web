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

namespace Modules\Jembatan\Controllers;

use App\Controllers\BaseController;
use Modules\Jembatan\Models as Jembatan;
use Modules\Utility\Models as Utility;

class Data_jembatan extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->M_Jembatan = new Jembatan\Model_jembatan();
        $this->tahun = $this->log['tahun'];
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

    function loadDataJembatan($jembatan_id = null)
    {
        return $jembatan_id ? $this->M_Jembatan->getDataJembatan(['a.jembatan_id' => $jembatan_id, 'tahun' => $this->tahun])->getRowArray() : $this->M_Jembatan->getDataJembatan()->getResultArray();
    }
    
    function loadSpesifikasiJembatan($jembatan_id = null){
        return $jembatan_id ? $this->M_Jembatan->getSpesifikasiJembatan(['a.jembatan_id' => $jembatan_id, 'tahun'=> $this->tahun])->getRowArray() : $this->M_Jembatan->getSpesifikasiJembatan()->getResult();
    }
    function loadTipeKondisiJembatan($jembatan_id = null){
        return $jembatan_id ? $this->M_Jembatan->getTipeKondisiJembatan(['a.jembatan_id' => $jembatan_id, 'tahun'=> $this->tahun])->getResultArray() : $this->M_Jembatan->getTipeKondisiJembatan()->getResultArray();
    }

}
