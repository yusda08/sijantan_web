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

class Model_banner extends Model
{
    protected $table = 'app_banner';
    protected $primaryKey = 'banner_id';
    protected $allowedFields = ['banner_judul', 'banner_ket', 'foto_path', 'foto_name'];

}
