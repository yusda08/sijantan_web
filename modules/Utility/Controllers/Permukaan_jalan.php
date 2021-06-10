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

class Permukaan_jalan extends BaseController
{
    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/permukaan_jalan';

    public function __construct()
    {
        parent::__construct();
        $this->M_JlnPermukaan = new Utility\Model_permukaan_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jalan\permukaan\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getPermukaanJalan'] = $this->M_JlnPermukaan->findAll();
        $record['ribbon'] = ribbon('Utility', 'Permukaan Jalan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('permukaan_id');
        $data = ['permukaan_nama' => $this->post('permukaan_nama')];
        try {
            $query = $id ? $this->M_JlnPermukaan->update($id, $data) : $this->M_JlnPermukaan->insert($data);
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
            $query = $this->M_JlnPermukaan->delete($id);
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
            'permukaan_nama' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }


}
