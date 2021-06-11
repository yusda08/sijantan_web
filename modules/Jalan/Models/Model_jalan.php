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

class Model_jalan extends Model
{
    protected $table = 'data_jalan';
    protected $primaryKey = 'jalan_id';
    protected $allowedFields = ['status_id', 'klasifikasi_id', 'ruas_no', 'ruas_nama'];

}
