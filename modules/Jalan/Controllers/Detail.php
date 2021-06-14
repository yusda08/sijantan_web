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
use Modules\Jalan\Controllers as C_Jalan;
use Modules\Utility\Models as Utility;

class Detail extends BaseController
{

    private $module = 'Modules\Jalan\Views', $moduleUrl = 'jalan/detail';

    public function __construct()
    {
        parent::__construct();
        $this->C_DataJalan = new C_Jalan\Data_jalan();
        $this->M_Kondisi = new Utility\Model_kondisi_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\detail\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['jalan'] = $this->get('jalan');
        $record['row_jln'] = $this->C_DataJalan->loadDataJalan($record['jalan']);
        $record['getKondisiJalan'] = $this->C_DataJalan->loadKondisiJalan($record['jalan']);
        $record['getKondisi'] = $this->M_Kondisi->findAll();
        $record['ribbon'] = ribbon('Jalan', 'Detail Jalan');
        $this->render($record);
    }

    function addKondisi(){
        cekCsrfToken($this->post('token'));
        $data = [
            'tahun' => $this->getTahun(),
            'jalan_id' => $this->post('jalan_id'),
            'kondisi_id' => $this->post('kondisi_id'),
            'panjang' => $this->post('panjang'),
            'keterangan' => $this->post('keterangan'),
        ];
        try {
            $query = $this->insert_duplicate('data_jalan_kondisi', $data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Kondisi Jalan'];
        }catch (\Exception $th){
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }



}
