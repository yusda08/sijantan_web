<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Referensi\Models;

use CodeIgniter\Model;

class Model_kabupaten extends Model
{
    protected $table = 'ref_kabupaten';
    protected $primaryKey = 'kab_kode';
    protected $allowedFields = ['prov_kode', 'kab_nama'];

}
