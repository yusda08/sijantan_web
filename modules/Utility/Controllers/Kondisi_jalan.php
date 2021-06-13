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

class Kondisi_jalan extends BaseController
{
    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/kondisi_jalan';

    public function __construct()
    {
        parent::__construct();
        $this->M_JlnKondisi = new Utility\Model_kondisi_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jalan\kondisi\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKondisiJalan'] = $this->M_JlnKondisi->findAll();
        $record['ribbon'] = ribbon('Utility', 'Kondisi Jalan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('kondisi_id');
        $data = ['kondisi_nama' => $this->post('kondisi_nama')];
        try {
            $query = $id ? $this->M_JlnKondisi->update($id, $data) : $this->M_JlnKondisi->insert($data);
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
            $query = $this->M_JlnKondisi->delete($id);
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
            'kondisi_nama' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }


}
