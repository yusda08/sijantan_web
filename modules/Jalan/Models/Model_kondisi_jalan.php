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
    public function getKategori($arrayWhere = null){
        $build = $this->builder()->select('*')->join('uti_jalan_kondisi', 'uti_jalan_kondisi.kondisi_id = data_jalan_kondisi.kondisi_id')
                ->join('uti_jalan_kategori', 'uti_jalan_kategori.kategori_jalan_id = uti_jalan_kondisi.kategori_jalan_id');
        if($arrayWhere){
            $build->where($arrayWhere);
        }
        return $build->get();
    }

}
