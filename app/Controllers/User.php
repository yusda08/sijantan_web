<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Modules\Setting\Models as Setting;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;

class User extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        parent::__construct();
        $this->M_User = new Setting\Model_user();
    }

    function index()
    {
        try {
            $getData = parent::validateTokenUser();
            if (!$getData) {
                return $this->respond($this->setResponse('User tidak ada dalam Database'));
            }
            if ($getData['is_active'] == 0) {
                return $this->respond($this->setResponse('User Sedang Tidak Aktif'));
            }
            if($getData){
                $dataArray = $this->setResponse('Success', 'ResponseInterface::HTTP_OK', $getData);
            }else{
                $dataArray = $this->setResponse('Gagal Commit Database');
            }
        }catch (\Exception $th){
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray, $dataArray['status']);
    }

}
