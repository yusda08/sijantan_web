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

namespace Modules\Jalan\Controllers;

use App\Controllers\BaseController;
use Modules\Jalan\Controllers as C_Jalan;
use Modules\Master\Models as Master;
use Modules\Referensi\Models as Referensi;
use Modules\Utility\Models as Klasifikasi;
use Modules\Jalan\Models as Jalan;


class Input_data extends BaseController
{

    private $module = 'Modules\Jalan\Views', $moduleUrl = 'jalan/input_data';

    public function __construct()
    {
        parent::__construct();
        $this->C_DataJalan = new C_Jalan\Data_jalan();
        $this->M_Jalan = new Jalan\Model_jalan();
        $this->M_Koordinat = new Jalan\Model_koordinat_jalan();
//        $this->M_Koordinat = new Master\Model_koordinat_jalan();
        $this->M_Kec = new Referensi\Model_kecamatan();
        $this->M_Klasifikasi = new Referensi\Model_kecamatan();
        $this->M_Klasifikasi = new Klasifikasi\Model_klasifikasi_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\input\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('Jalan', 'Input Data Jalan');
        $this->render($record);
    }

    function formAdd()
    {
        $record['content'] = $this->module . '\input\form_add';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKecamatan'] = $this->M_Kec->findAll();
        $record['getKlasifikasi'] = $this->M_Klasifikasi->findAll();
        $record['ribbon'] = ribbon('Jalan', 'Form Tambah Jalan');
        $this->render($record);
    }

    function formUpdate()
    {
        $record['content'] = $this->module . '\input\form_update';
        $record['jalan'] = $this->get('jalan');
        $record['row_jln'] = (array)json_decode($this->C_DataJalan->loadDataJalan($record['jalan']), true);
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKecamatan'] = $this->M_Kec->findAll();
        $record['getKlasifikasi'] = $this->M_Klasifikasi->findAll();
        $record['ribbon'] = ribbon('Jalan', 'Form Edit Jalan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $kecamatan = implode(',', $this->post('kecamatan[]'));
        $data = [
            'klasifikasi_id' => $this->post('klasifikasi_id'),
            'ruas_no' => $this->post('ruas_no'),
            'kecamatan' => $kecamatan,
            'ruas_nama' => $this->post('ruas_nama'),
            'ruas_status' => $this->post('ruas_status'),
            'ruas_panjang' => $this->post('ruas_panjang'),
            'ruas_nama_pangkal' => $this->post('ruas_nama_pangkal'),
            'ruas_nama_ujung' => $this->post('ruas_nama_ujung'),
            'ruas_titik_pangkal' => $this->post('ruas_titik_pangkal'),
            'ruas_titik_ujung' => $this->post('ruas_titik_ujung'),
        ];
        $koordinat = json_decode($this->post('koordinat'));
        try {
            $query = $this->insert_data('data_jalan', $data);
            if ($query) {
                $row_jln = $this->M_Jalan->where(['ruas_no' => $this->post('ruas_no')])->first();
                $array = [];
                foreach ($koordinat as $item) {
                    $arr['longitude'] = $item[0];
                    $arr['latitude'] = $item[1];
                    $arr['jalan_id'] = $row_jln['jalan_id'];
                    $this->insert_data('data_jalan_koordinat', $arr);
                }
                $msg = ['status' => true, 'ket' => 'Input Data jalan'];
            } else {
                $msg = ['status' => false, 'ket' => 'Input Data jalan'];
            }
        } catch (\Exception $th) {
            $msg = ['status' => true, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function updateData()
    {
        cekCsrfToken($this->post('token'));
        $kecamatan = implode(',', $this->post('kecamatan[]'));
        $jalan_id = $this->post('jalan_id');
        $data = [
            'klasifikasi_id' => $this->post('klasifikasi_id'),
            'ruas_no' => $this->post('ruas_no'),
            'kecamatan' => $kecamatan,
            'ruas_nama' => $this->post('ruas_nama'),
            'ruas_status' => $this->post('ruas_status'),
            'ruas_panjang' => $this->post('ruas_panjang'),
            'ruas_nama_pangkal' => $this->post('ruas_nama_pangkal'),
            'ruas_nama_ujung' => $this->post('ruas_nama_ujung'),
            'ruas_titik_pangkal' => $this->post('ruas_titik_pangkal'),
            'ruas_titik_ujung' => $this->post('ruas_titik_ujung'),
        ];
        try {
            $query = $this->update_data('jalan_id', $jalan_id, 'data_jalan', $data);
            if ($query) {
                $this->flashdata('Update Data Jalan', true);
                return redirect()->to(site_url('jalan/detail?jalan=' . $jalan_id));
            } else {
                $this->flashdata('Update Data Jalan', false);
                return redirect()->back();
            }
        } catch (\Exception $th) {
            $this->flashdata($th->getMessage(), false);
            return redirect()->back();
        }
    }

    function deleteData()
    {
        $this->cekNotIsAjax();
        $jalan_id = $this->post('jalan_id');
        try {
            $query = $this->delete_data('jalan_id', $jalan_id, 'data_jalan');
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Gagal Delete Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }


}
