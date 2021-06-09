<?php

namespace Modules\Home\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{

    private $module = 'Modules\Home\Views';
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $view = $this->module . '\form_login';
        $data = [];
        if ($this->log) {
            return redirect()->to(site_url('home'));
        }
        return view($view, $data);
    }


    public function validasiLogin()
    {
        $this->cekNotIsAjax();
        $this->cekNotIsPOST();
        cekCsrfToken($this->post('token'));
        try {
            $username = $this->post('username');
            $password = $this->post('password');
            $username = $this->db->escape($username);
            $row = $this->M_Auth->where('username', str_replace("'", '', $username))->first();
            if (password_verify($password, $row['password'])) {
                if ($row['is_active'] == 1) {
                    $key = random_string('alnum', 64);
                    set_cookie('sijantan_session', $key, 3600 * 24 * 30);
                    $data = $this->sessionAplikasi($row['kd_level'], $row['kd_user']);
                    session()->set('is_logined', $data);
                    $status = $data ? true : false;
                    $ket = $data ? 'Berhasil Login' : 'Gagal Login';
                    $msg = ['status' => $status, 'ket' => $status, 'error' => ''];
                } else {
                    $msg = ['status' => false, 'ket' => 'Status User Belum Aktif', 'error' => ''];
                }
            } else {
                $msg = ['status' => false, 'ket' => 'Password Tidak Sesuai', 'error' => ''];
            }
        } catch (\Throwable $th) {
            $msg = ['status' => false, 'ket' => 'Ada Kesalah Sistem', 'error' => $th->getMessage()];
        }
        echo json_encode($msg);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('/'));
    }


}
