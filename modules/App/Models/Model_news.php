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

class Model_news extends Model
{
    protected $table = 'app_news';
    protected $primaryKey = 'news_id';
    protected $allowedFields = ['news_judul', 'news_ket', 'news_tgl'];

}
