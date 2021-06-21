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
        $authenticationHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $encodedToken = getJWTFromRequest($authenticationHeader);
        $key = \Config\Services::getSecretKey();
        $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
        $getData = $this->M_User->where(['username' => $decodedToken->username])->find();
        $dataArray = [
            'msg' => 'Berhasil',
            'status' => ResponseInterface::HTTP_OK,
            'data' => $getData
        ];
        return $this->respond($dataArray);
    }

}
