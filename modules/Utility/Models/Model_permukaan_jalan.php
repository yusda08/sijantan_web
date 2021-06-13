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

class Model_permukaan_jalan extends Model
{
    protected $table = 'uti_jalan_permukaan';
    protected $primaryKey = 'permukaan_id';
    protected $allowedFields = ['permukaan_nama'];

}
