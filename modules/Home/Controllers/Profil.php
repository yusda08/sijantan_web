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

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->log = aksesLog();
        $this->M_Auth = new Model_Auth();
    }

    function index() {
        if ($this->log) {
            $view = 'Modules\Home\Views\view_profil_user';
            $record = $this->javasc_back();
            $record['log'] = $this->log;
            $data = $this->layout_back($view, $record);
            $data['ribbon_left'] = ribbon_left('Home', 'Profil User');
            $data['ribbon_right'] = ribbon_right($this->log['ket_level']);
            echo $this->backend($data);
        } else {
            return redirect()->to(site_url('/Login'));
        }
    }

    function verifikasi_password() {
        $pass = $this->post('pass');
        $kd_user = $this->post('kd_user');
        $row = $this->M_Auth->get_user($kd_user)->getRow();
        if (password_verify($pass, $row->password)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function updateUser() {
        $kd_user = $this->post('kd_user');
        $pass = $this->post('password_lama');
        $row = $this->M_Auth->get_user($kd_user)->getRow();
        $info = 'Gagal';
        if (password_verify($pass, $row->password)) {
            $data['nama_user'] = $this->post('nama_user');
            $data['password'] = password_hash($this->post('password_baru'), PASSWORD_BCRYPT);
            $ket = 'Update Data User';
            $query = $this->update_data('kd_user', $kd_user, 'user', $data);
            if ($query) {
                $info = 'Berhasil';
            }
        } else {
            $ket = 'Password Lama Tidak Cocok';
        }
        $this->flashdata($ket, $info);
        return redirect()->back();
    }

}
