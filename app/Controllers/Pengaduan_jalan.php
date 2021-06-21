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
    }

    function index()
    {
        $valid = parent::validateTokenUser();
        $getData = $this->M_PJalan->where('kd_user', $valid['kd_user'])->findAll();
        $getAsset = $this->M_PAssetJalan->findAll();
        foreach ($getData as $i => $row) {
            $array = [];
            foreach ($getAsset as $asset) {
                if ($asset['tiket_kode'] == $row['tiket_kode']) {
                    $arr['id_asset'] = $asset['aset_pengaduan_id'];
                    $arr['lat'] = $asset['lat'];
                    $arr['long'] = $asset['long'];
                    $arr['foto_path'] = $asset['foto_path'];
                    $arr['foto_name'] = $asset['foto_name'];
                    $arr['foto_name_thumb'] = $asset['foto_name_thumb'];
                    $array[] = $arr;
                }
            }
            $getData[$i]['asset'] = $array;
        }
        $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $getData);
        return $this->respond($dataArray);
    }

    function create()
    {
        $valid = parent::validateTokenUser();
        if ($valid) {
            try {
                $guid = $this->getGUID();
                $data['jalan_id'] = $this->post('jalan_id');
                $data['pengadu_ket'] = $this->post('keterangan');
                $data['kd_user'] = $valid['kd_user'];
                $data['pengadu_nama'] = $valid['nama_user'];
                $data['pengadu_no_hp'] = $valid['no_telpon'];
                $data['pengadu_tgl'] = date('Y-m-d H:i:s');
                $data['tiket_kode'] = $guid;
                $this->db->transBegin();
                $this->M_PJalan->insert($data);
                //upload File
                $arr = [];
                if ($file = $this->request->getFiles()) {
                    $long = $this->post('long[]');
                    $lat = $this->post('lat[]');
                    foreach ($file['file_images'] as $i => $img) {
                        if ($img->isValid() && ! $img->hasMoved()) {
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
                            $arr['foto'] = $arrray;
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
        } else {
            $dataArray = $this->setResponse('User tidak ada dalam Database');
        }
        return $this->respond($dataArray);
    }

}
