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

namespace Modules\Jembatan\Controllers;

use App\Controllers\BaseController;
use Modules\Jembatan\Controllers as C_Jembatan;
use Modules\Master\Models as Master;
use Modules\Referensi\Models as Referensi;
use Modules\Utility\Models as Utility;
use Modules\Jembatan\Models as Jembatan;

class Input_data extends BaseController {

    private $module = 'Modules\Jembatan\Views', $moduleUrl = 'jembatan/input_data';

    public function __construct() {
        parent::__construct();
        $this->C_DataJembatan = new C_Jembatan\Data_jembatan();
        $this->M_Jembatan = new Jembatan\Model_jembatan();
        $this->M_Kec = new Referensi\Model_kecamatan();
        $this->M_Kondisi = new Utility\Model_kondisi_jembatan();
        $this->M_TipeKondisi = new Utility\Model_tipekondisi_jembatan();
        $this->tahun = $this->log['tahun'];
    }

    function index() {
        $record['content'] = $this->module . '\input\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('Jembatan', 'Input Data Jembatan');
        $this->render($record);
    }

    function formAdd() {
        $record['content'] = $this->module . '\input\form_add';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKecamatan'] = $this->M_Kec->findAll();
        $record['getKondisi'] = $this->M_Kondisi->findAll();
        $record['getTipeKondisi'] = $this->M_TipeKondisi->findAll();
        $record['ribbon'] = ribbon('Jembatan', 'Form Tambah Jembatan');
        $this->render($record);
    }
    
    function formUpdate()
    {
        $record['content'] = $this->module . '\input\form_update';
        $record['jembatan'] = $this->get('jembatan');
        $record['row_jbtn'] = $this->C_DataJembatan->loadDataJembatan($record['jembatan']);
        $record['getKondisi'] = $this->M_Kondisi->findAll();
        $record['getLoadTipeKondisi'] = $this->C_DataJembatan->loadTipeKondisiJembatan();
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getKecamatan'] = $this->M_Kec->findAll();
        $record['ribbon'] = ribbon('Jembatan', 'Form Edit Jembatan');
        $this->render($record);
    }

    function addData() {
        cekCsrfToken($this->post('token'));
        $kecamatan = implode(',', $this->post('kecamatan[]'));
        $data = [
            'nomor' => $this->post('nomor'),
            'nama' => $this->post('nama'),
            'ruas' => $this->post('ruas'),
            'sta' => $this->post('sta'),
            'kecamatan' => $kecamatan,
            'latitude' => $this->post('latitude'),
            'longitude' => $this->post('longitude')
        ];
        try {
            $query = $this->insert_data('data_jembatan', $data);
            if ($query) {
                $row_jembatan = $this->M_Jembatan->where(['nomor' => $this->post('nomor')])->first();
                $data_spek = [
                    'kondisi_id' => $this->post('kondisi_id'),
                    'panjang' => $this->post('panjang'),
                    'lebar' => $this->post('lebar'),
                    'jumlah_bentang' => $this->post('jumlah_bentang'),
                    'jembatan_id' => $row_jembatan['jembatan_id'],
                    'tahun' => date('Y')
                ];
                $this->insert_data('data_jembatan_spesifikasi', $data_spek);

                $getTipeKondisi = $this->M_TipeKondisi->findAll();
                foreach ($getTipeKondisi as $row_tipe) {
                    $tipekondisi_id = $row_tipe['tipekondisi_id'];
                    $data_tipekondisi = [
                        'jembatan_id' => $row_jembatan['jembatan_id'],
                        'kondisi_id' => $this->post('tipekondisi' . $tipekondisi_id),
                        'tipe' => $this->post('tipe' . $tipekondisi_id),
                        'tahun'=> date('Y'),
                        'tipekondisi_id' => $tipekondisi_id
                    ];
                    $this->insert_data('data_jembatan_tipekondisi', $data_tipekondisi);
                }
                $this->flashdata('Input Data Jembatan', true);
                return redirect()->to(site_url('jembatan/input_data'));
            } else {
                $this->flashdata('Input Data Jembatan', false);
                return redirect()->back();
            }
        } catch (\Exception $th) {
            $this->flashdata($th->getMessage(), false);
            return redirect()->back();
        }
    }
    
    function updateData()
    {
        cekCsrfToken($this->post('token'));
        $kecamatan = implode(',', $this->post('kecamatan[]'));
        $data = [
            'nomor' => $this->post('nomor'),
            'nama' => $this->post('nama'),
            'ruas' => $this->post('ruas'),
            'sta' => $this->post('sta'),
            'kecamatan' => $kecamatan,
            'latitude' => $this->post('latitude'),
            'longitude' => $this->post('longitude')
        ];
        $jembatan_id = $this->post('jembatan_id');
        
        try {
            $query = $this->update_data('jembatan_id', $jembatan_id, 'data_jembatan', $data);
            if ($query) {
                $where = ['tahun'=> $this->tahun, 'jembatan_id'=> $jembatan_id];
                $data_spek = [
                    'kondisi_id' => $this->post('kondisi_id'),
                    'panjang' => $this->post('panjang'),
                    'lebar' => $this->post('lebar'),
                    'jumlah_bentang' => $this->post('jumlah_bentang'),
                ];
                
                $this->update_where($where, 'data_jembatan_spesifikasi', $data_spek);
//
                $getTipeKondisi = $this->M_TipeKondisi->findAll();
                
                foreach ($getTipeKondisi as $row_tipe) {
                    $tipekondisi_id = $row_tipe['tipekondisi_id'];
                    $where = ['tahun'=> $this->tahun, 'jembatan_id'=> $jembatan_id, 'tipekondisi_id'=> $tipekondisi_id];
                    $data_tipekondisi = [
                        'kondisi_id' => $this->post('tipekondisi' . $tipekondisi_id),
                        'tipe' => $this->post('tipe' . $tipekondisi_id)
                    ];
                    $this->update_where($where, 'data_jembatan_tipekondisi', $data_tipekondisi);
                }
                $this->flashdata('Update data Jembatan', true);
                return redirect()->to(site_url('jembatan/input_data'));
            } else {
                $this->flashdata('Update data Jembatan', false);
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
        $jembatan_id = $this->post('jembatan_id');
        try {
            $where = ['tahun'=> $this->tahun, 'jembatan_id'=> $jembatan_id];
            $query = $this->delete_where($where, 'data_jembatan_spesifikasi');
            $query = $this->delete_where($where, 'data_jembatan_tipekondisi');
            $query = $this->delete_data('jembatan_id', $jembatan_id, 'data_jembatan');
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Delete Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

}
