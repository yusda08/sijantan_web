<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Referensi\Models;

use CodeIgniter\Model;

class Model_kecamatan extends Model
{
    protected $table = 'ref_kecamatan';
    protected $primaryKey = 'kec_kode';
    protected $allowedFields = ['prov_kode','kab_kode', 'kec_nama'];

}
