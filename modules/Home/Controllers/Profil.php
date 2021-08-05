<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Home\Controllers;

/**
 * Description of Profil
 *
 * @author Yusda Helmani
 */
use App\Controllers\BaseController;
use App\Models\Model_Auth;

class Profil extends BaseController {
    protected $module = 'Modules\Home\Views', $moduleUrl = 'home/profil';
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->log = aksesLog();
        $this->M_Auth = new Model_Auth();
    }

    function index() {
        $record['log'] = aksesLog();
        $record['content'] = $this->module.'\profile';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('Home', 'Profile');
        $this->render($record);
    }

    function forgetPassword() {
        cekCsrfToken($this->post('token'));
        try {
            $kd_user = $this->post('kd_user');
            $data['password'] = password_hash($this->post('password'), PASSWORD_BCRYPT);
            $query = $this->update_data('kd_user', $kd_user, 'user', $data);
            $msg =['status' => $query ? true : false, 'ket' => 'Update Password'];
        }catch (\Exception $th){
            $msg =['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

}
