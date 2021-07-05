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

namespace Modules\Master\Controllers;

use App\Controllers\BaseController;
use Modules\Master\Models as Master;

class Koordinat extends BaseController
{
    private $module = 'Modules\Jalan\Views', $moduleUrl = 'master/koordinat';

    public function __construct()
    {
        parent::__construct();
        $this->M_Koordinat = new Master\Model_subjekpajak();
    }

    function index()
    {
        $record['content'] = $this->module . '\koordinat\index';
        $record['moduleUrl'] = $this->moduleUrl;

        $record['ribbon'] = ribbon('Jalan', 'Input Data Jalan');
        $this->render($record);
    }

    function loadJsonKoordinat(){
        $getDataJalan = $this->M_Koordinat->where('katagori', 'JALAN')->first();
        $json = json_decode($getDataJalan['geojson']);
        $getData = array();
        foreach ($json->features as $i => $row) {
            $arr['id'] =  $row->id;
            $arr['coordinates'] =  $row->geometry->coordinates;
            $arr['properties'] = $row->properties;
            $getData[] = $arr;
        }
        echo json_encode($getData);
    }
    
    function loadGeoJsonJalan(){
        $getDataJalan = $this->M_Koordinat->where('katagori', 'JALAN')->first();
        echo $getDataJalan['geojson'];
    }

}
