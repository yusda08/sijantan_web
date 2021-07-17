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

class Model_kategori_jalan extends Model
{
    protected $table = 'uti_jalan_kategori';
    protected $primaryKey = 'kategori_jalan_id';
    protected $allowedFields = ['nm_kategori'];
    
}
