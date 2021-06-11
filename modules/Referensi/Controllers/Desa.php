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

class Desa extends BaseController
{
    private $module = 'Modules\Referensi\Views', $moduleUrl = 'referensi/desa';

    public function __construct()
    {
        parent::__construct();
        $this->M_desa = new Referensi\Model_desa;
        $this->M_kabupaten = new Referensi\Model_kabupaten;
        $this->M_kecamatan = new Referensi\Model_kecamatan;
    }

    function index()
    {
        $record['content'] = $this->module . '\desa\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getDesa'] = $this->M_desa->findAll();
        $record['getKabupaten'] = $this->M_kabupaten->asObject()->findAll();
        $record['ribbon'] = ribbon('Utility', 'Permukaan Jalan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $desa_kode = $this->post('desa_kode');
        $data = ['desa_kode'=>$desa_kode, 'desa_nama' => $this->post('desa_nama'), 'kec_kode' => $this->post('kec_kode'), 'kab_kode' => $this->post('kab_kode'), 'prov_kode' => $this->post('prov_kode')];
        try {
            $query = $this->M_desa->replace($data);
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
        $desa_kode = $this->post('desa_kode');
        try {
            $query = $this->M_desa->delete($desa_kode);
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
    
    public function loadKecamatan() {
        $kab_kode = $this->get('kab_kode', true);
        $getKecamatan = $this->M_kecamatan->asObject()->where('kab_kode', $kab_kode)->findAll();

        $field = '<option value="">.: Pilih Kecamatan :.</option>';
        foreach ($getKecamatan as $row) {
            $field .= '<option 
                value="' . $row->kec_kode . '">' . $row->kec_nama . " ($row->kec_kode)".'</option>';
        }
        echo $field;
    }


}
