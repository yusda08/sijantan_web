<?php

namespace Modules\Pengaduan\Controllers;

use App\Controllers\BaseController;
use Modules\Pengaduan\Models as Pengaduan;

class Pengaduan_jalan extends BaseController {

    private $module = 'Modules\Pengaduan\Views', $moduleUrl = 'pengaduan/jalan';

    public function __construct() {
        parent::__construct();
        $this->M_PJalan = new Pengaduan\Model_pengaduan_jalan();
        $this->M_PResponJalan = new Pengaduan\Model_pengaduan_respon_jalan();
        $this->M_PAssetJalan = new Pengaduan\Model_pengaduan_asset_jalan();
    }

    function index() {
        $record['content'] = $this->module . '\jalan\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('Pengaduan', 'Jalan');
        $this->render($record);
    }

    function detail() {
        $record['content'] = $this->module . '\jalan\detail';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['tiket'] = $this->get('tiket');
        $record['row_tiket'] = $this->M_PJalan->getPengaduanJalan(['tiket_kode' => $record['tiket']])->getRowArray();
        $record['getRespon'] = $this->M_PResponJalan->where(['tiket_kode' => $record['tiket']])->findAll();
        $record['getAsset'] = $this->M_PAssetJalan->where(['tiket_kode' => $record['tiket']])->findAll();
        $record['ribbon'] = ribbon('Pengaduan', 'Jalan / Detail');
        $this->render($record);
    }

    function addData() {
        cekCsrfToken($this->post('token'));
        $kets = $this->post('keterangan[]');
        $tiket = $this->post('tiket');
        
        $rules = [
            'file' => [
                'rules' => 'is_image[file]',
                'errors' => [
                    'is_image' => 'Yang dipilih Bukan Foto'
                ]
            ]
        ];

        $path = "public/uploads/img/pengaduan/respon_jalan/";
        if (!file_exists(ROOTPATH . $path)) {
            mkdir(ROOTPATH . $path, 0777, true);
        }
        $file = $this->file('file');
        try {
            $this->db->transBegin();
            $this->update_data('tiket_kode', $tiket, 'pengaduan_jalan', ['status_respon' => 1]);
            foreach ($kets as $i => $ket) {
                $data['respon_ket'] = $ket;
                $data['respon_tgl'] = dateNow();
                $data['tiket_kode'] = $this->post('tiket');
                if ($this->validate($rules) and $file->getName()) {
                    $data['foto_name'] = $file->getRandomName();
                    $data['foto_path'] = $path;
                    $file->move(ROOTPATH . $path, $data['foto_name']);
                }
                $this->insert_data('pengaduan_jalan_respon', $data);
            }
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                $msg = ['status' => false, 'ket' => 'Gagal Input Data Pengaduan'];
            } else {
                $this->db->transCommit();
                $msg = ['status' => true, 'ket' => 'Berhasil Input Data Pengaduan'];
            }
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function deleteData() {
        $this->cekNotIsAjax();
        $id = $this->post('id');
        $count = $this->post('count');
        $tiket = $this->post('tiket');
        try {
            $this->db->transBegin();
            if ($count == 1) {
                $this->update_data('tiket_kode', $tiket, 'pengaduan_jalan', ['status_respon' => 0]);
            }
            $asset = $this->M_PResponJalan->getWhere(['respon_id' => $id])->getRowArray();
            $this->delete_data('respon_id', $id, 'pengaduan_jalan_respon');
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                $msg = ['status' => false, 'ket' => 'Gagal Delete Data Pengaduan'];
            } else {
                try {
                    unlink(ROOTPATH . $asset['foto_path'] . $asset['foto_name']);
                } catch (\Exception $ex) {
                    
                }
                $this->db->transCommit();
                $msg = ['status' => true, 'ket' => 'Berhasil Delete Data Pengaduan'];
            }
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function deleteDataTiket() {
        $this->cekNotIsAjax();
        $tiket = $this->post('tiket');
        try {
            $query = $this->delete_data('tiket_kode', $tiket, 'pengaduan_jalan');
            if ($query) {
                $status = true;
                $assets = $this->M_PAssetJalan->where(['tiket_kode' => $tiket])->findAll();
                foreach ($assets as $asset) {
                    unlink(ROOTPATH . $asset['foto_path'] . $asset['foto_name']);
                    unlink(ROOTPATH . $asset['foto_path'] . $asset['foto_name_thumb']);
                }
            } else {
                $status = false;
            }
            $msg = ['status' => $status, 'ket' => 'Berhasil Delete Data Pengaduan'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function loadDataTable() {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $dir = $this->request->getPost('order[0][dir]');
        $getData = $this->M_PJalan->getResource($search)->orderBy('pengadu_tgl')->limit($length, $start)->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['ruas_nama'] = sprintfNumber($row['ruas_no'], 3) . ' - ' . $row['ruas_nama'];
            $getData[$i]['pengadu_tgl'] = tgl_indo($row['pengadu_tgl']);
        }
        return $this->respond([
                    'draw' => $this->post('draw'),
                    'recordsTotal' => $this->M_PJalan->getResource()->countAllResults(),
                    'recordsFiltered' => $this->M_PJalan->getResource($search)->countAllResults(),
                    'data' => $getData,
        ]);
    }

}
