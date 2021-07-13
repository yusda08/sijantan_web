<?php

namespace Modules\App\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;

class Unit extends BaseController
{
    private $module = 'Modules\App\Views', $moduleUrl = 'aplikasi/unit';

    public function __construct()
    {
        parent::__construct();
        $this->M_Unit = new App\Model_unit();
    }

    function index()
    {
        $record['content'] = $this->module . '\unit\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['row_unit'] = $this->M_Unit->first();
        $record['ribbon'] = ribbon('Aplikasi', 'Profile Unit');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('id');
        $rules = ['alamat' => 'required', 'no_telpon' => 'required', 'email' => 'required', 'link_fb' => 'required', 'link_instagram' => 'required', 'link_youtube' => 'required'];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
        $data = [
            'alamat' => $this->post('alamat'),
            'no_telpon' => $this->post('no_telpon'),
            'email' => $this->post('email'),
            'link_fb' => $this->post('link_fb'),
            'link_instagram' => $this->post('link_instagram'),
            'link_youtube' => $this->post('link_youtube'),
        ];
        try {
            $que = $this->M_Unit->update($id, $data);
            $status = $que ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Profile Unit'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

}
