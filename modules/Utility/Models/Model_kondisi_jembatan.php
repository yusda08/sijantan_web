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

namespace Modules\Utility\Models;

use CodeIgniter\Model;

class Model_kondisi_jembatan extends Model
{
    protected $table = 'uti_jembatan_kondisi';
    protected $primaryKey = 'kondisi_id';
    protected $allowedFields = ['kondisi_nama', 'kategori_jembatan_id'];
    
    function getKondisiJembatanKategori(){
        $build = $this->db->table($this->table.' a')->select('a.kondisi_id, a.kondisi_nama, a.kategori_jembatan_id, b.nm_kategori')
                ->join('uti_jembatan_kategori b', 'a.kategori_jembatan_id = b.kategori_jembatan_id', 'left');
        return $build->get();
    }

}
