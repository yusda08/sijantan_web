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

namespace Modules\Setting\Models;

use CodeIgniter\Model;

class Model_menu extends Model
{

    protected $table = 'menu';
    protected $primaryKey = 'id';

    function getMenuAkses($kd_level)
    {
        return $this->db->query("SELECT b.* FROM menu b where id in(select id_menu from menu_role a where a.kd_level=$kd_level) order by parent, urutan asc");
    }

    function getMenuRole($arrayWhere = null)
    {
        $build = $this->db->table($this->table)->select('*')->join('menu_role', 'id=id_menu');
        if ($arrayWhere) {
            $build->where($arrayWhere);
        }
        return $build->get();
    }
}
