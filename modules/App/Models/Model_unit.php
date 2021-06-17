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

namespace Modules\App\Models;

use CodeIgniter\Model;

class Model_unit extends Model
{
    protected $table = 'app_unit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['alamat', 'email', 'no_telpon'];

}
