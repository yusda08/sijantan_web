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

class Model_tipekondisi_jembatan extends Model
{
    protected $table = 'uti_jembatan_tipekondisi';
    protected $primaryKey = 'tipekondisi_id';
    protected $allowedFields = ['tipekondisi_nama'];

}
