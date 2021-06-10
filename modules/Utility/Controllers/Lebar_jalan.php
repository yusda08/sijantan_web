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

class Lebar_jalan extends BaseController
{
    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/lebar_jalan';

    public function __construct()
    {
        parent::__construct();
        $this->M_JlnLebar = new Utility\Model_lebar_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jalan\lebar\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getLebarJalan'] = $this->M_JlnLebar->findAll();
        $record['ribbon'] = ribbon('Utility', 'Permukaan Jalan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('lebar_id');

        $data = ['lebar_nama' => $this->request->getPost('lebar_nama')];
        try {
            $query = $id ? $this->M_JlnLebar->update($id, $data) : $this->M_JlnLebar->insert($data);
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
            $query = $this->M_JlnLebar->delete($id);
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
            'lebar_nama' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }


}
