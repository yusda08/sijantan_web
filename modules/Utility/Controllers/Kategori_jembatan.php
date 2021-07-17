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

class Kategori_jembatan extends BaseController
{
    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/kategori_jembatan';

    public function __construct()
    {
        parent::__construct();
        $this->M_JembatanKategori = new Utility\Model_kategori_jembatan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jembatan\kategori\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKategoriJembatan'] = $this->M_JembatanKategori->findAll();
        $record['ribbon'] = ribbon('Utility', 'Kategori Jembatan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('kategori_jembatan_id');
        $data = [
            'nm_kategori' => $this->post('nm_kategori'),
        ];
        try {
            $query = $id ? $this->M_JembatanKategori->update($id, $data) : $this->M_JembatanKategori->insert($data);
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
            $query = $this->M_JembatanKategori->delete($id);
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
            'kategori_nama' => 'required',
            'kategori_inisial' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }


}
