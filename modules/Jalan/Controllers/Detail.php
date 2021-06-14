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

class Detail extends BaseController
{

    private $module = 'Modules\Jalan\Views', $moduleUrl = 'jalan/detail';

    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $record['content'] = $this->module . '\detail\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['jalan'] = $this->get('jalan');
        $record['ribbon'] = ribbon('Jalan', 'Detail Jalan');
        $this->render($record);
    }



}
