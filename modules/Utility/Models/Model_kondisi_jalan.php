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

class Model_kondisi_jalan extends Model
{
    protected $table = 'uti_jalan_kondisi';
    protected $primaryKey = 'kondisi_id';
    protected $allowedFields = ['kondisi_nama'];

}
