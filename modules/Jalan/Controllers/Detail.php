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
use Modules\Jalan\Models as Jalan;
use Modules\Utility\Models as Utility;

class Detail extends BaseController
{

    private $module = 'Modules\Jalan\Views', $moduleUrl = 'jalan/detail';

    public function __construct()
    {
        parent::__construct();
        $this->C_DataJalan = new C_Jalan\Data_jalan();
        $this->M_AssetJalan = new Jalan\Model_asset_jalan();
        $this->M_Kondisi = new Utility\Model_kondisi_jalan();
        $this->M_Permukaan = new Utility\Model_permukaan_jalan();
    }

    function index()
    {
        $record['content'] = $this->module . '\detail\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['jalan'] = $this->get('jalan');
        $record['row_jln'] = (array)json_decode($this->C_DataJalan->loadDataJalan($record['jalan']), true);
        $record['getKondisiJalan'] = $this->C_DataJalan->loadKondisiJalan($record['jalan']);
        $record['getPermukaanJalan'] = $this->C_DataJalan->loadPermukaanJalan($record['jalan']);
        $record['getLebarJalan'] = $this->C_DataJalan->loadLebarJalan($record['jalan']);
        $record['getAssetJalan'] = $this->M_AssetJalan->where(['jalan_id' => $record['jalan']])->findAll();
        $record['ribbon'] = ribbon('Jalan', 'Detail Jalan');
        $this->render($record);
    }

    function addKondisi()
    {
        cekCsrfToken($this->post('token'));
        $aksi = $this->post('aksi');
        $data = [
            'tahun' => $this->getTahun(),
            'jalan_id' => $this->post('jalan_id'),
            $aksi . '_id' => $this->post('aksi_id'),
            'panjang' => $this->post('panjang'),
            'keterangan' => $this->post('keterangan'),
        ];

        try {
            $query = $this->insert_duplicate('data_jalan_' . $aksi, $data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data ' . $aksi . ' Jalan'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function deleteFoto(){
            $this->cekNotIsAjax();
            $id = $this->post('id');
            try {
                $aksi = $this->M_AssetJalan->delete($id);
                if ($aksi) {
                    unlink(ROOTPATH . $this->post('foto_path') . $this->post('foto_name'));
                }
                $info = $aksi ? true : false;
                $msg = [ 'status' => $info, 'ket' => 'Menghapus File Foto'];
            } catch (\Exception $th) {
                $msg = [ 'status' => false, 'ket' => $th->getMessage()];
            }
            echo json_encode($msg);
    }

    function uploadFoto()
    {
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
        $path = "public/uploads/img/";
        if (!file_exists(ROOTPATH . $path)) {
            mkdir(ROOTPATH . $path, 0777, true);
        }
        $file = $this->file('file');
//        return var_dump($file);
        try {
            $data['jalan_id'] = $this->post('jalan_id');
            $data['foto_judul'] = $this->post('foto_judul');
            $data['foto_name'] = $file->getRandomName();
            $data['foto_path'] = $path;
            $file->move(ROOTPATH .$path, $data['foto_name']);
            $que = $this->M_AssetJalan->insert($data);
            $info = $que ? true : false;
            $msg = ['status' => $info, 'ket' => 'Upload File Foto'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata( $msg['ket'], $msg['status']);
        return redirect()->back();
    }


}
