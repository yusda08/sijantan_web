<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_Auth
 *
 * @author Yusda Helmani
 */

namespace App\Models;

use CodeIgniter\Model;

class M_pengaduan_jalan extends Model
{
    //put your code here
    protected $table = 'pengaduan_jalan';
    protected $primaryKey = 'tiket_kode';
    protected $allowedFields = ['tiket_kode', 'kd_user', 'jalan_nama', 'pengadu_nama', 'pengadu_no_hp', 'pengadu_ket', 'pengadu_tgl'];

    public function getResource(array $arrayWhere = null)
    {
        $build = $this->_query();
        if ($arrayWhere) {
            $build->where($arrayWhere);
        }
        return $build;
    }

    private function _query()
    {
        return $this->db->table($this->table)->select('*');
    }

}
