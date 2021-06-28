<?php

namespace App\Controllers;

use App\Libraries;
use App\Models as Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;


class Pengaduan_jalan extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->M_PJalan = new Model\M_pengaduan_jalan();
        $this->M_PAssetJalan = new Model\M_pengaduan_asset_jalan();
        $this->M_PResponJalan = new Model\M_pengaduan_respon_jalan();
    }

    function index()
    {
        $valid = parent::validateTokenUser();
        if (!$valid) {
            return $this->respond($this->setResponse('User tidak ada dalam Database'));
        }
        if ($valid['is_active'] == 0) {
            return $this->respond($this->setResponse('User Sedang Tidak Aktif'));
        }
        $getData = $this->M_PJalan->getResource(['kd_user', $valid['kd_user']])->get()->getResultArray();
        $getAsset = $this->M_PAssetJalan->findAll();
        $getRespon = $this->M_PResponJalan->findAll();
        foreach ($getData as $i => $row) {
            $arrayAsset = [];
            foreach ($getAsset as $asset) {
                if ($asset['tiket_kode'] == $row['tiket_kode']) {
                    $arr['id_asset'] = $asset['aset_pengaduan_id'];
                    $arr['lat'] = $asset['lat'];
                    $arr['long'] = $asset['long'];
                    $arr['foto_path'] = base_url($asset['foto_path']);
                    $arr['foto_name'] = $asset['foto_name'];
                    $arr['foto_name_thumb'] = $asset['foto_name_thumb'];
                    $arrayAsset[] = $arr;
                }
            }
            $arrayRespon = [];
            foreach ($getRespon as $res) {
                if ($res['tiket_kode'] == $row['tiket_kode']) {
                    $arrRes['respon_ket'] = $res['respon_ket'];
                    $arrRes['respon_tgl'] = $res['respon_tgl'];
                    $arrayRespon[] = $arrRes;
                }
            }
            $getData[$i]['asset'] = $arrayAsset;
            $getData[$i]['respon'] = $arrayRespon;
        }
        $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $getData);
        return $this->respond($dataArray);
    }

    function create()
    {
        $valid = parent::validateTokenUser();
        if (!$valid) {
            return $this->respond($this->setResponse('User tidak ada dalam Database'));
        }
        if ($valid['is_active'] == 0) {
            return $this->respond($this->setResponse('User Sedang Tidak Aktif'));
        }
        try {
            $guid = $this->getGUID();
            $data['jalan_id'] = $this->post('jalan_id');
            $data['pengadu_ket'] = $this->post('keterangan');
            $data['kd_user'] = $valid['kd_user'];
            $data['pengadu_nama'] = $valid['nama_user'];
            $data['pengadu_no_hp'] = $valid['no_telpon'];
            $data['pengadu_tgl'] = date('Y-m-d');
            $data['tiket_kode'] = $guid;
            $this->db->transBegin();
            $this->M_PJalan->insert($data);
            //upload File
            $arr = [];
            if ($file = $this->request->getFiles()) {
                $long = $this->post('long[]');
                $lat = $this->post('lat[]');
                foreach ($file['file_images'] as $i => $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $path = "public/uploads/img/pengaduan/jalan/";
                        if (!file_exists(ROOTPATH . $path)) {
                            mkdir(ROOTPATH . $path, 0777, true);
                        }
                        $dataAsset['tiket_kode'] = $data['tiket_kode'];
                        $dataAsset['lat'] = $lat[$i];
                        $dataAsset['long'] = $long[$i];
                        $dataAsset['foto_path'] = $path;
                        $dataAsset['foto_name'] = $img->getRandomName();
                        $img->move(ROOTPATH . $path, $dataAsset['foto_name']);
                        $ImageLib = new Libraries\ImagesLib();
                        $explodeNameFile = explode('.', $dataAsset['foto_name']);
                        $explodeNameFile[0] .= '_thumb.';
                        $smallNameFile = implode($explodeNameFile);
                        $ImageLib->uploadCompress($path, $dataAsset['foto_name'], $smallNameFile);
                        $dataAsset["foto_name_thumb"] = $smallNameFile;
                        $arrray[] = $dataAsset;
                        $arr['asset'] = $arrray;
                        $this->insert_data('pengaduan_jalan_aset', $dataAsset);
                    }
                }
            }
            if ($this->db->transStatus() == FALSE) {
                $this->db->transRollback();
                $dataArray = $this->setResponse('Gagal Commit Database');
            } else {
                $this->db->transCommit();
                $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, array_merge($data, $arr));
            }
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray);
    }

    function delete($tiket)
    {
        $valid = parent::validateTokenUser();
        if (!$valid) {
            return $this->respond($this->setResponse('User tidak ada dalam Database'));
        }
        if ($valid['is_active'] == 0) {
            return $this->respond($this->setResponse('User Sedang Tidak Aktif'));
        }
        try {
            $dataJln = $this->M_PJalan->where('tiket_kode', $tiket)->first();
            $assets = $this->M_PAssetJalan->where('tiket_kode', $tiket)->findAll();
            if($dataJln['status_respon'] == 1){
                return $this->respond($this->setResponse('Tidak bisa di Hapus karena Tiket Sudah di Respon'));
            }
            $query = $this->M_PJalan->delete($tiket);
            if ($query) {
                foreach ($assets as $asset) {
                    unlink(ROOTPATH . $asset['foto_path'] . $asset['foto_name']);
                    unlink(ROOTPATH . $asset['foto_path'] . $asset['foto_name_thumb']);
                }
            }
            $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK);
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray, $dataArray['status']);
    }

}
