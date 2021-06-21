<?php

namespace Modules\Frontend\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;
use Modules\Jalan\Models as Jalan;

class Home extends BaseController
{

    protected $module = 'Modules\Frontend\Views';

    public function __construct()
    {
        parent::__construct();
        $this->M_Run = new App\Model_running_text();
        $this->M_Unit = new App\Model_unit();
        $this->M_Jalan = new Jalan\Model_jalan();
    }

    function index()
    {
        $record['running'] = $this->M_Run->where(['status_aktif' => 1])->first();
        $record['unit'] = $this->M_Unit->first();
        $record['getJalan'] = $this->M_Jalan->getResource()->get()->getResultArray();
        $record['content'] = $this->module . '\index';
        $record['ribbon'] = ribbon('Home');
        $this->frontend($record);
    }

    function aktivasi($key)
    {
        $username = decodeUrl($key);
        $record['content'] = $this->module . '\aktivasi';
        $record['ribbon'] = ribbon('Aktifasi User');
        try {
            $data['is_active'] = 1;
            $query = $this->update_data('username', $username, 'user', $data);
            $status = $query ? true : false;
            $record['get_row'] = ['status' => $status, 'ket' => 'Aktivasi User Silahkan Lakukan Login Melalui Aplikasi Mobile'];
            $this->frontend($record);
        } catch (\Exception $th) {
            $record['get_row'] = ['status' => false, 'ket' => $th->getMessage()];
            $this->frontend($record);
        }
    }

    function forgetPassword($key = null)
    {
        $record['username'] = decodeUrl($key);
        $record['content'] = $this->module . '\forget_password';
        $record['ribbon'] = ribbon('Forget Password');
        $this->frontend($record);
    }

    function updatePassword()
    {
//        $this->cekNotIsAjax();
        $username = $this->post('username');
        $password = $this->post('password');
        try {
            $new_password = password_hash($password, PASSWORD_BCRYPT);
            $data['password'] = $new_password;
            $query = $this->update_data('username', $username, 'user', $data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Update Data Password'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }


}
