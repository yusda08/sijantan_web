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
        $this->M_DataJalan = new Jalan\Model_jalan();
    }

    function loadDataJalan()
    {
        $getDataJalan = $this->M_DataJalan->findAll();

        return $getDataJalan;
    }


}
