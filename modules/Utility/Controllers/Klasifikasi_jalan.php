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

namespace Modules\Utility\Controllers;

use App\Controllers\BaseController;
use Modules\Utility\Models as Utility;

class Klasifikasi_jalan extends BaseController
{
    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/klasifikasi_jalan';

    public function __construct()
    {
        parent::__construct();
        $this->M_JlnKlasifikasi = new Utility\Model_klasifikasi_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jalan\klasifikasi\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKlasifikasiJalan'] = $this->M_JlnKlasifikasi->findAll();
        $record['ribbon'] = ribbon('Utility', 'Klasifikasi Jalan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('klasifikasi_id');
        $data = [
            'klasifikasi_nama' => $this->post('klasifikasi_nama'),
            'klasifikasi_inisial' => $this->post('klasifikasi_inisial'),
        ];
        try {
            $query = $id ? $this->M_JlnKlasifikasi->update($id, $data) : $this->M_JlnKlasifikasi->insert($data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Input Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function deleteData()
    {
        $id = $this->post('id');
        try {
            $query = $this->M_JlnKlasifikasi->delete($id);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Menghapus Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        echo json_encode($msg);
    }

    private function _formValidation()
    {
        $rules = [
            'klasifikasi_nama' => 'required',
            'klasifikasi_inisial' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }


}
