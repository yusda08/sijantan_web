<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Modules\Setting\Models as Setting;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models as Model;


class Auth extends BaseController
{

    use ResponseTrait;

    //put your code here
    protected $format = 'json';

    public function __construct()
    {
        parent::__construct();
        $this->M_User = new Setting\Model_user();
        $this->M_Token = new Model\Model_token();
    }

    function index()
    {
        $getData = $this->M_User->findAll();
        $dataArray = [
            'msg' => 'Berhasil',
            'status' => ResponseInterface::HTTP_OK,
            'data' => $getData
        ];
        return $this->respond($dataArray);
    }

    function login()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $row_token = $this->M_Token->select('token')->where(['username' => $username])->first();
        $row_user = $this->M_Auth->where('username', str_replace("'", '', $username))->first();
        try {
            if ($row_user) {
                $data = array_merge($row_user, $row_token);
                if (password_verify($password, $row_user['password'])) {
                    if ($row_user['is_active'] == 1) {
                        $dataArray = $this->setResponse('Berhasil Login', ResponseInterface::HTTP_OK, $data);
                    } else {
                        $dataArray = $this->setResponse('Status User Tidak Aktif');
                    }
                } else {
                    $dataArray = $this->setResponse('Password Tidak Sesuai');
                }
            } else {
                $dataArray = $this->setResponse('Username Tidak ada dalam Database');
            }

        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray, $dataArray['status']);
    }

    function register()
    {
        $data['kd_level'] = 2;
        $data['is_active'] = 0;
        $data['username'] = $this->post('email');
        $data['password'] = password_hash($this->post('password'), PASSWORD_BCRYPT);;
        $data['nama_user'] = $this->post('nama');
        $data['email'] = $this->post('email');
        $data['no_telpon'] = $this->post('no_telpon');
        try {
            $this->db->transBegin();
            $this->insert_data('user', $data);
            $input['username'] = $data['username'];
            $input['token'] = getSignedJWTForUser($data['username']);
            $this->insert_data('user_token', $input);
            $info = $this->db->transStatus() == FALSE ? $this->db->transRollback() : $this->db->transCommit();
            if ($info) {
                //Send Email
                $linkSurat = base_url("frontend/home/aktivasi/" . encodeUrl($data['username']));
                $message = "<h1>Notifikasi Aktivasi User</h1>
                <p>Tidak untuk dibalas karena ini hanya pemberitahuan</p>
                <p>Link Aktifasi : {$linkSurat}</p>";
                $title = 'Notifikasi Aktivasi User Si-JanTan';
                $this->sendEmail($title, $message, $data['email']);
                $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK, $data);
            } else {
                $dataArray = $this->setResponse('Gagal Register');
            }
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray, $dataArray['status']);
    }

    function forgetPassword()
    {
        $username = $this->post('email');
        $row_user = $this->M_Auth->where('username', str_replace("'", '', $username))->first();
        try {
            if ($row_user) {
                $linkSurat = base_url("frontend/home/forget_password/" . encodeUrl($username));
                $message = "<h1>Notifikasi Forget Password User</h1>
                <p>Tidak untuk dibalas karena ini hanya pemberitahuan</p>
                <p>Link Forget Password : {$linkSurat}</p>";
                $title = 'Notifikasi Forget Password Si-JanTan';
                $this->sendEmail($title, $message, $username);
                $dataArray = $this->setResponse('Success', ResponseInterface::HTTP_OK);
            } else {
                $dataArray = $this->setResponse('Email Tidak Terdaftar');
            }
        } catch (\Exception $th) {
            $dataArray = $this->setResponse($th->getMessage());
        }
        return $this->respond($dataArray, $dataArray['status']);
    }

}
