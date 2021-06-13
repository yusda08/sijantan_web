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

namespace Modules\Master\Models;

use CodeIgniter\Model;

class Model_koordinat_jalan extends Model
{
    protected $table = 'master_koordinat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['geojson', 'file_path', 'file_name', 'keterangan', 'katagori'];
}
