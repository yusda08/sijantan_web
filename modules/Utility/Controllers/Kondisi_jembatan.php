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

class Kondisi_jembatan extends BaseController {

    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/kondisi_jembatan';

    public function __construct() {
        parent::__construct();
        $this->M_JembatanKondisi = new Utility\Model_kondisi_jembatan();
        $this->M_JembatanKategori = new Utility\Model_kategori_jembatan();
    }

    function index() {
        $record['content'] = $this->module . '\jembatan\kondisi\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKategoriJembatan'] = $this->M_JembatanKategori->findAll();
        $record['getKondisiJembatan'] = $this->M_JembatanKondisi->getKondisiJembatanKategori()->getResultArray();
        $record['ribbon'] = ribbon('Utility', 'Kondisi Jembatan');
        $this->render($record);
    }

    function loadJson() {
        $getKondisiJala = $this->M_JembatanKondisi->findAll();
        return json_encode($getKondisiJala);
    }

    function addData() {
        cekCsrfToken($this->post('token'));
        $id = $this->post('kondisi_id');
        $data = [
                    'kondisi_nama' => $this->post('kondisi_nama'),
            'kategori_jembatan_id' => $this->post('kategori_jembatan_id'),
                    ];
//        var_dump($data);
        try {
            $query = $id ? $this->M_JembatanKondisi->update($id, $data) : $this->M_JembatanKondisi->insert($data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Input Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function deleteData() {
        $id = $this->post('id');
        try {
            $query = $this->M_JembatanKondisi->delete($id);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Menghapus Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        echo json_encode($msg);
    }

    private function _formValidation() {
        $rules = [
            'kondisi_nama' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }

}
