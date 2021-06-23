<?php

namespace App\Controllers;

use App\Models as Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Jalan\Models as Jalan;


class Data_jalan extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->M_Jalan = new Jalan\Model_jalan();
        $this->M_KoordinatJalan = new Jalan\Model_koordinat_jalan();
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
        $getData = $this->M_Jalan->select('jalan_id, ruas_no, ruas_nama')->findAll();

        foreach ($getData as $i => $get) {
            $row_koordinat = $this->M_KoordinatJalan->where('jalan_id', $get['jalan_id'])->first();
            $getData[$i]['lat'] = $row_koordinat['latitude'];
            $getData[$i]['long'] = $row_koordinat['longitude'];
        }
        try {
            $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $getData);
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray);
    }

}
