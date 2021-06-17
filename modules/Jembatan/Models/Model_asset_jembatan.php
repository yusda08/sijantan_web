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

namespace Modules\Jembatan\Models;

use CodeIgniter\Model;

class Model_asset_jembatan extends Model
{
    protected $table = 'data_jembatan_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jembatan_id', 'foto_judul', 'foto_path', 'foto_name'];


}
