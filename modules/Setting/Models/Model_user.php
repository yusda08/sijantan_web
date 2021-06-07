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

use App\Models\MY_Model;

class Model_user extends MY_Model
{

    protected $table = 'user';
    protected $primaryKey = 'kd_user';
    protected $allowedFields = ['username', 'password', 'nama_user'];
    protected $returnType = 'array';

    public function maxUser()
    {
        $builder = $this->db->table($this->table)->selectMax('kd_user', 'jml_user');
        $query = $builder->get()->getRow()->jml_user;
        $query = is_null($query) ? 1 : $query + 1;
        return $query;
    }

    function getUser($whereArray = null)
    {
        $builder = $this->_get_user_query($whereArray);
        if (@$_POST['length'] != -1) {
            $builder->limit(@$_POST['length'], @$_POST['start']);
        }
        return $builder->get();
    }

    private function _get_user_query($whereArray = null)
    {
        $column_order = array('kode_group', 'ket_level', 'nama_user');
        $column_search = array('ket_level', 'nama_user');
        $order = array('kd_level' => 'asc');
        $builder = $this->db->table($this->table . ' a');
        $builder->select('a.*, c.kd_level, c.ket_level, d.kode_group')
            ->join('user_previliges b', 'a.kd_user=b.kd_user')
            ->join('user_level c', 'c.kd_level=b.kd_level')
            ->join('user_group d', 'd.kd_user=a.kd_user', 'left');
        if ($whereArray) {
            $builder->where($whereArray);
        }
        $builder = $this->attrServerSide($builder, $column_search, $column_order, $order);
        return $builder;
    }

    function count_filtered_user($whereArray = null)
    {
        $builder = $this->_get_user_query($whereArray);
        return count($builder->get()->getResult());
    }

    function getUserLevel()
    {
        $builder = $this->db->table('user_level')->select('*');
        return $builder->get();
    }


}
