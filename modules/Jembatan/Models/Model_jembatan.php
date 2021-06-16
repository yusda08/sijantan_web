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

namespace Modules\Jembatan\Models;

use CodeIgniter\Model;

class Model_jembatan extends Model
{
    protected $table = 'data_jembatan';
    protected $primaryKey = 'jembatan_id';
    protected $allowedFields = ['nomor', 'nama', 'kecamatan', 'ruas', 'sta'];

    public function getResource(string $search = null)
    {
        $build = $this->_query();
        if ($search) {
            $build->groupStart()
                ->like('nama', $search)
                ->orLike('ruas', $search)
                ->orLike('kecamatan', $search)
                ->groupEnd();
        }
        return $build;
    }

    public function getDataJembatan($arrayWhere = null)
    {
        $build = $this->_query();
        if($arrayWhere){
            $build->where($arrayWhere);
        }
        return $build->get();
    }

    private function _query()
    {
        return $this->db->table($this->table . ' a');
    }

}
