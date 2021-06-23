<?php

namespace App\Controllers;

use App\Models as Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;


class Running_text extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->M_RunText = new Model\M_Running_text();
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
            $getData = $this->M_RunText->where('status_aktif',1)->first();
            if($getData){
                $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $getData);
            }else{
                $dataArray = $this->setResponse('Data Running Text Kosong');
            }
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray);
    }

}
