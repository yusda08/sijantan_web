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

class Kecamatan extends BaseController
{
    private $module = 'Modules\Referensi\Views', $moduleUrl = 'referensi/kecamatan';

    public function __construct()
    {
        parent::__construct();
        $this->M_desa = new Referensi\Model_desa;
        $this->M_kabupaten = new Referensi\Model_kabupaten;
        $this->M_kecamatan = new Referensi\Model_kecamatan;
    }

    function index()
    {
        $record['content'] = $this->module . '\kecamatan\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKecamatan'] = $this->M_kecamatan->findAll();
        $record['getKabupaten'] = $this->M_kabupaten->asObject()->findAll();
        $record['ribbon'] = ribbon('Referensi', 'Kecamatan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $kec_kode = $this->post('kec_kode');
        $data = ['kec_kode'=>$kec_kode, 'kec_nama' => $this->post('kec_nama'),'kab_kode' => $this->post('kab_kode'), 'prov_kode' => $this->post('prov_kode')];
        try {
            $query = $this->M_kecamatan->replace($data);
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
        $kec_kode = $this->post('kec_kode');
        try {
            $query = $this->M_kecamatan->delete($kec_kode);
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
            'kec_nama' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }
}
