<?php

namespace Modules\Pengaduan\Controllers;

use App\Controllers\BaseController;
use Modules\Pengaduan\Models as Pengaduan;

class Pengaduan_jembatan extends BaseController
{
    private $module = 'Modules\Pengaduan\Views', $moduleUrl = 'pengaduan/jembatan';

    public function __construct()
    {
        parent::__construct();
        $this->M_PJembatan = new Pengaduan\Model_pengaduan_jembatan();
        $this->M_PResponJembatan = new Pengaduan\Model_pengaduan_respon_jembatan();
        $this->M_PAssetJembatan = new Pengaduan\Model_pengaduan_asset_jembatan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jembatan\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['ribbon'] = ribbon('Pengaduan', 'Jembatan');
        $this->render($record);
    }

    function detail()
    {
        $record['content'] = $this->module . '\jembatan\detail';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['tiket'] = $this->get('tiket');
        $record['row_tiket'] = $this->M_PJembatan->getPengaduanJembatan(['tiket_kode' => $record['tiket']])->getRowArray();
        $record['getRespon'] = $this->M_PResponJembatan->where(['tiket_kode' => $record['tiket']])->findAll();
        $record['getAsset'] = $this->M_PAssetJembatan->where(['tiket_kode' => $record['tiket']])->findAll();
        $record['ribbon'] = ribbon('Pengaduan', 'Jalan / Detail');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $kets = $this->post('keterangan[]');
        $tiket = $this->post('tiket');
        try {
            $this->db->transBegin();
            $this->update_data('tiket_kode', $tiket, 'pengaduan_jembatan', ['status_respon' => 1]);
            foreach ($kets as $i => $ket) {
                $data['respon_ket'] = $ket;
                $data['respon_tgl'] = dateNow();
                $data['tiket_kode'] = $this->post('tiket');
                $this->insert_data('pengaduan_jembatan_respon', $data);
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

    function deleteData()
    {
        $this->cekNotIsAjax();
        $id = $this->post('id');
        $count = $this->post('count');
        $tiket = $this->post('tiket');
        try {
            $this->db->transBegin();
            if ($count == 1) {
                $this->update_data('tiket_kode', $tiket, 'pengaduan_jembatan', ['status_respon' => 0]);
            }
            $this->delete_data('respon_id', $id, 'pengaduan_jembatan_respon');
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                $msg = ['status' => false, 'ket' => 'Gagal Delete Data Pengaduan'];
            } else {
                $this->db->transCommit();
                $msg = ['status' => true, 'ket' => 'Berhasil Delete Data Pengaduan'];
            }
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function deleteDataTiket()
    {
        $this->cekNotIsAjax();
        $tiket = $this->post('tiket');
        try {
            $query = $this->delete_data('tiket_kode', $tiket, 'pengaduan_jembatan');
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

    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $dir = $this->request->getPost('order[0][dir]');
        $getData = $this->M_PJembatan->getResource($search)->orderBy('pengadu_tgl')->limit($length, $start)->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['nama'] = sprintfNumber($row['nomor'], 3) . ' - ' . $row['nama'];
            $getData[$i]['pengadu_tgl'] = tgl_indo($row['pengadu_tgl']);
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_PJembatan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_PJembatan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }


}
