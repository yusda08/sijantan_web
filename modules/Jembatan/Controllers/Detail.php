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
use Modules\Jembatan\Controllers as C_Jembatan;
use Modules\Utility\Models as Utility;

class Detail extends BaseController
{

    private $module = 'Modules\Jembatan\Views', $moduleUrl = 'jembatan/detail';

    public function __construct()
    {
        parent::__construct();
        $this->C_DataJembatan = new C_Jembatan\Data_jembatan();
        $this->M_Kondisi = new Utility\Model_kondisi_jembatan();
    }

    function index()
    {
        $record['content'] = $this->module . '\detail\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['jembatan'] = $this->get('jembatan');
        $record['row_jembatan'] = $this->C_DataJembatan->loadDataJembatan($record['jembatan']);
        $record['getTipeKondisiJembatan'] = $this->C_DataJembatan->loadTipeKondisiJembatan($record['jembatan']);
        $record['rowSpesifikasiJembatan'] = $this->C_DataJembatan->loadSpesifikasiJembatan($record['jembatan']);
        $record['ribbon'] = ribbon('Jembatan', 'Detail Jembatan');
        $this->render($record);
    }

    function addKondisi(){
        cekCsrfToken($this->post('token'));
        $data = [
            'tahun' => $this->getTahun(),
            'jembatan_id' => $this->post('jembatan_id'),
            'kondisi_id' => $this->post('kondisi_id'),
            'panjang' => $this->post('panjang'),
            'keterangan' => $this->post('keterangan'),
        ];
        try {
            $query = $this->insert_duplicate('data_jembatan_kondisi', $data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Kondisi Jembatan'];
        }catch (\Exception $th){
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }



}
