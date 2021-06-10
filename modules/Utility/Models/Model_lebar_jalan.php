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

class Model_lebar_jalan extends Model
{
    protected $table = 'uti_jalan_lebar';
    protected $primaryKey = 'lebar_id';
    protected $allowedFields = ['lebar_nama'];

}
