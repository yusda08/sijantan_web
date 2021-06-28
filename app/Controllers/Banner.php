<?php

namespace App\Controllers;

use App\Models as Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;


class Banner extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->M_Banner = new Model\M_Banner();
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
            $getData = $this->M_Banner->findAll();
            if($getData){
                foreach ($getData as $i => $row) {
                    $getData[$i]['foto_path'] = base_url($row['foto_path']);
                }
                $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $getData);
            }else{
                $dataArray = $this->setResponse('Data Banner Kosong');
            }
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }

        return $this->respond($dataArray, $dataArray['status']);
    }

}
