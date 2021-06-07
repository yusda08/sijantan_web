<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Yusda Helmani
 */

namespace Modules\Setting\Controllers;

use App\Controllers\BaseController;

use Modules\Setting\Models as Setting;

class User extends BaseController
{
    private $module = 'Modules\Setting\Views';
    private $moduleUrl = 'setting/user';

    public function __construct()
    {
        parent::__construct();
        $this->M_User = new Setting\Model_user();
    }

    function index()
    {
        $record['content'] = $this->module . '\user\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['kd_level'] = $this->_get('level');
        $record['getUser'] = $this->M_User->findAll();
        $record['getUserLevel'] = $this->M_User->getUserLevel()->getResultArray();
        $record['ribbon'] = ribbon('Setting', 'User');
        $this->render($record);
    }

    function insertUser()
    {
        cekCsrfToken($this->post('token'));
        $this->_formValidation();
        try {
            $ket = 'Menambahkan Data User';
            $password = $this->post('password');
            $new_password = password_hash($password, PASSWORD_BCRYPT);
            $data['kd_user'] = $this->M_User->maxUser();
            $data['username'] = $this->post('username');
            $data['kd_level'] = $this->post('kd_level');
            $data['kode_group'] = $this->post('kode_group');
            $data['nama_user'] = $this->post('nama_user');
            $data['password'] = $new_password;
            $data['is_active'] = 1;
            $que = $this->insert_data('user', $data);
            $info = $que ? true : false;
        } catch (\Throwable $th) {
            $ket = $th->getMessage();
            $info = 'false';
        }
        $this->flashdata($ket, $info);
        return redirect()->back();
    }

    private function _formValidation()
    {
        $rules = [
            'username' => 'required|is_unique[user.username]',
            'password' => 'required|min_length[6]',
            'nama_user' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }

    function resetPassword()
    {
        try {
            $ket = 'Reset Password';
            $kd_user = $this->post('kd_user');
            $password = '123456';
            $new_password = password_hash($password, PASSWORD_BCRYPT);
            $data['password'] = $new_password;
            $que = $this->update_data('kd_user', $kd_user, 'user', $data);
            $msg = ['status' => true, 'ket' => 'Berhasil Reset Data'];
        } catch (\Throwable $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function isActive()
    {
        try {
            $kd_user = $this->post('kd_user');
            $data['is_active'] = $this->post('is_active') == 1 ? 0 : 1;
            $que = $this->update_data('kd_user', $kd_user, 'user', $data);
            $msg = ['status' => true, 'ket' => 'Update Status User'];
        } catch (\Throwable $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function deleteUser()
    {
        try {
            $kd_user = $this->post('kd_user');
            $this->delete_data('kd_user', $kd_user, 'user');
            $msg = ['status' => true, 'ket' => 'Delete Status User'];
        } catch (\Throwable $th) {
            $msg = ['status' => true, 'ket' => 'Delete Status User'];
        }
        return json_encode($msg);
    }

    function getUsername()
    {
        $username = $this->post('username');
        $build = $this->M_User->where('username', $username)->first();
        return json_encode($build);
    }
}
