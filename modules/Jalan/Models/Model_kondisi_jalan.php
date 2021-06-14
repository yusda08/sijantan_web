<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_setting
 *
 * @author Yusda Helmani
 */

namespace Modules\Jalan\Models;

use CodeIgniter\Model;

class Model_kondisi_jalan extends Model
{
    protected $table = 'data_jalan_kondisi';

    private function _query()
    {
        return $this->builder()->select('*');
    }

    public function getKondisi($arrayWhere = null){
        $build = $this->_query();
        if($arrayWhere){
            $build->where($arrayWhere);
        }
        return $build->get();
    }

}
