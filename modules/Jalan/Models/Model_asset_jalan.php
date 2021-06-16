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

class Model_asset_jalan extends Model
{
    protected $table = 'data_jalan_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jalan_id', 'foto_judul', 'foto_path', 'foto_name'];


}
