<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Referensi\Models;

use CodeIgniter\Model;

class Model_desa extends Model
{
    protected $table = 'ref_desa';
    protected $primaryKey = 'desa_kode';
    protected $allowedFields = ['kec_kode', 'kab_kode', 'prov_kode', 'desa_nama'];

}
