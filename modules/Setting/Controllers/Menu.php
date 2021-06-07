<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Setting\Controllers;

/**
 * Description of Role_menu
 *
 * @author Yusda Helmani
 */

use App\Controllers\BaseController;
use Modules\Setting\Models as Setting;

class Menu extends BaseController
{
    private $module = 'Modules\Setting\Views';
    private $moduleUrl = 'setting/menu';

    public function __construct()
    {
        parent::__construct();
        $this->M_User = new Setting\Model_user();
        $this->M_Menu = new Setting\Model_menu();
    }

    function index()
    {
        $record['content'] = $this->module . '\menu\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['kd_level'] = $this->_get('level');
        $record['getUserLevel'] = $this->M_User->getUserLevel()->getResultArray();
        $record['getMenu'] = $this->M_Menu->findAll();
        $whereArray = $record['kd_level'] ? ['kd_level' => $record['kd_level']] : '';
        $record['getMenuAkses'] = $this->M_Menu->getMenuRole($whereArray)->getResultArray();
        $record['ribbon'] = ribbon('Setting', 'Menu');
        $this->render($record);
    }

    function inputMenu(){
        $this->cekNotIsAjax();
        $this->cekNotIsPOST();
        cekCsrfToken($this->post('token'));
        $parent = $this->post('parent');
        try {
            if($parent){
                $data['id_menu'] = $parent;
                $data['kd_level'] = $this->post('kd_level');
                $this->insert_duplicate('menu_role', $data);
            }
            $data['id_menu'] = $this->post('id_menu');
            $data['kd_level'] = $this->post('kd_level');
            $que = $this->insert_duplicate('menu_role', $data);
            $status = $que ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Input Role Menu'];
        }catch (\Throwable $th){
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function deleteMenu(){
        $this->cekNotIsAjax();
        $this->cekNotIsPOST();
        cekCsrfToken($this->post('token'));
        try {
            $column['id_menu'] = $this->post('id_menu');
            $column['kd_level'] = $this->post('kd_level');
            $que = $this->delete_where($column, 'menu_role');
            $status = $que ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Menghapus Role Menu'];
        }catch (\Throwable $th){
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }
}
