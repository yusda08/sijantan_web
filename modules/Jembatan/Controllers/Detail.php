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
use Modules\Utility\Models as Utility;

class Detail extends BaseController {

    private $module = 'Modules\Jembatan\Views', $moduleUrl = 'jembatan/detail';

    public function __construct() {
        parent::__construct();
        $this->C_DataJembatan = new C_Jembatan\Data_jembatan();
        $this->M_Kondisi = new Utility\Model_kondisi_jembatan();
        $this->M_AssetJembatan = new \Modules\Jembatan\Models\Model_asset_jembatan();
    }

    function index() {
        $record['content'] = $this->module . '\detail\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['jembatan'] = $this->get('jembatan');
        $record['row_jembatan'] = $this->C_DataJembatan->loadDataJembatan($record['jembatan']);
        $record['getTipeKondisiJembatan'] = $this->C_DataJembatan->loadTipeKondisiJembatan($record['jembatan']);
        $record['rowSpesifikasiJembatan'] = $this->C_DataJembatan->loadSpesifikasiJembatan($record['jembatan']);
        $record['getAssetJembatan'] = $this->M_AssetJembatan->where(['jembatan_id' => $record['jembatan']])->findAll();
        $record['ribbon'] = ribbon('Jembatan', 'Detail Jembatan');
        $this->render($record);
    }

    function addKondisi() {
        cekCsrfToken($this->post('token'));
        $data = [
            'tahun' => $this->getTahun(),
            'jembatan_id' => $this->post('jembatan_id'),
            'kondisi_id' => $this->post('kondisi_id'),
            'panjang' => $this->post('panjang'),
            'keterangan' => $this->post('keterangan'),
        ];
        try {
            $query = $this->insert_duplicate('data_jembatan_kondisi', $data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Kondisi Jembatan'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function deleteFoto() {
        $this->cekNotIsAjax();
        $id = $this->post('id');
        try {
            $aksi = $this->M_AssetJembatan->delete($id);
            if ($aksi) {
                unlink(ROOTPATH . $this->post('foto_path') . $this->post('foto_name'));
            }
            $info = $aksi ? true : false;
            $msg = ['status' => $info, 'ket' => 'Menghapus File Foto'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        echo json_encode($msg);
    }

    function uploadFoto() {
        cekCsrfToken($this->post('token'));
        $rules = [
            'file' => [
                'rules' => 'is_image[file]',
                'errors' => [
                    'is_image' => 'Yang dipilih Bukan Foto'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $error = $this->validasi->getErrors();
            $this->flashdata($error['file'], false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
        $path = "public/uploads/img/jembatan/";
        if (!file_exists(ROOTPATH . $path)) {
            mkdir(ROOTPATH . $path, 0777, true);
        }
        $file = $this->file('file');
//        return var_dump($file);
        try {
            $data['jembatan_id'] = $this->post('jembatan_id');
            $data['foto_judul'] = $this->post('foto_judul');
            $data['foto_name'] = $file->getRandomName();
            $data['foto_path'] = $path;
            $file->move(ROOTPATH . $path, $data['foto_name']);
            $que = $this->M_AssetJembatan->insert($data);
            $info = $que ? true : false;
            $msg = ['status' => $info, 'ket' => 'Upload File Foto'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

}
