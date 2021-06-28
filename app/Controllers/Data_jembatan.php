<?php

namespace App\Controllers;

use App\Models as Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use http\Client\Response;
use Modules\Jembatan\Models as Jembatan;


class Data_jembatan extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->M_Jembatan = new Jembatan\Model_jembatan();
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
        try {
            $getData = $this->M_Jembatan->select('jembatan_id, nomor, nama, latitude, longitude')->findAll();
            if ($getData) {
                $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $getData);
            } else {
                return $this->respond($this->setResponse('Data Kosong !!!', ResponseInterface::HTTP_OK, []));
            }
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray, $dataArray['status']);
    }

}
