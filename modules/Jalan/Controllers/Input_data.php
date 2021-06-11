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
use Modules\Master\Models as Master;

class Input_data extends BaseController
{
    private $module = 'Modules\Jalan\Views', $moduleUrl = 'jalan/input_data';

    public function __construct()
    {
        parent::__construct();
        $this->C_DataJalan = new C_Jalan\Data_jalan();
        $this->M_Koordinat = new Master\Model_koordinat_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\input\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getDataJalan'] = $this->C_DataJalan->loadDataJalan();

        $record['ribbon'] = ribbon('Jalan', 'Input Data Jalan');
        $this->render($record);
    }

    function formAdd(){
        $record['content'] = $this->module . '\input\form_add';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getDataJalan'] = $this->C_DataJalan->loadDataJalan();

        $record['ribbon'] = ribbon('Jalan', 'Form Tambah Jalan');
        $this->render($record);
    }



}
