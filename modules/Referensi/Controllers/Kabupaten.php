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

namespace Modules\Referensi\Controllers;

use App\Controllers\BaseController;
use Modules\Referensi\Models as Referensi;

class Kabupaten extends BaseController
{
    private $module = 'Modules\Referensi\Views', $moduleUrl = 'referensi/kabupaten';

    public function __construct()
    {
        parent::__construct();
        $this->M_kabupaten = new Referensi\Model_kabupaten;
    }

    function index()
    {
        $record['content'] = $this->module . '\kabupaten\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKabupaten'] = $this->M_kabupaten->where()->findAll();
        $record['ribbon'] = ribbon('Referensi', 'Kabupaten');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $kab_kode = $this->post('kab_kode');
        $data = ['kab_nama' => $this->post('kab_nama'),'kab_kode' => $this->post('kab_kode'), 'prov_kode' => $this->post('prov_kode')];
        try {
            $query = $this->M_kabupaten->replace($data);
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
        $kab_kode = $this->post('kab_kode');
        try {
            $query = $this->M_kabupaten->delete($kab_kode);
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
            'kab_nama' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }
}
