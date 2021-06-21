<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_Auth
 *
 * @author Yusda Helmani
 */

namespace App\Models;

use CodeIgniter\Model;

class M_pengaduan_asset_jalan extends Model
{
    //put your code here
    protected $table = 'pengaduan_jalan_aset';
    protected $primaryKey = 'aset_pengaduan_id';
    protected $allowedFields = ['foto_path', 'foto_name', 'lat', 'long'];

}
