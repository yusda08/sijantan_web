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
            if($row_user){
                $data = array_merge($row_user, $row_token);
                if (password_verify($password, $row_user['password'])) {
                    if ($row_user['is_active'] == 1) {
                        $dataArray = [
                            'msg' => 'Berhasil Login',
                            'status' => ResponseInterface::HTTP_OK,
                            'result' => $data
                        ];
                    } else {
                        $dataArray = [
                            'msg' => 'Status User Tidak Aktif',
                            'status' => ResponseInterface::HTTP_BAD_REQUEST,
                            'result' => []
                        ];
                    }
                } else {
                    $dataArray = [
                        'msg' => 'Password Tidak Sesuai',
                        'status' => ResponseInterface::HTTP_BAD_REQUEST,
                        'result' => []
                    ];
                }
            }else{
                $dataArray = [
                    'msg' => 'Username Tidak ada dalam Database',
                    'status' => ResponseInterface::HTTP_BAD_REQUEST,
                    'result' => []
                ];
            }

        }catch (\Exception $th){
            $dataArray = [
                'msg' => $th->getMessage(),
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'result' => []
            ];
        }
        return $this->respond($dataArray);
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
                $linkSurat = base_url("home/aktivasi/".encodeUrl($data['username']));
                $message = "<h1>Notifikasi Aktivasi User</h1>
                <p>Tidak untuk dibalas karena ini hanya pemberitahuan</p>
                <p>Link Aktifasi : {$linkSurat}</p>";
                $title = 'Notifikasi Aktivasi User Si-JanTan';
                $this->sendEmail($title, $message, $data['email']);
                $dataArray = [
                    'msg' => 'Register Data User',
                    'status' => ResponseInterface::HTTP_OK
                ];
            } else {
                $dataArray = [
                    'msg' => 'Register Data User',
                    'status' => ResponseInterface::HTTP_BAD_REQUEST
                ];
            }
        } catch (\Exception $th) {
            $dataArray = [
                'msg' => $th->getMessage(),
                'status' => ResponseInterface::HTTP_BAD_REQUEST
            ];
        }
        return $this->respond($dataArray);
    }

    function forgetPassword()
    {
        $username = $this->post('email');
        $row_user = $this->M_Auth->where('username', str_replace("'", '', $username))->first();
        try {
            if($row_user){
                $linkSurat = base_url("home/forget_password/".encodeUrl($username));
                $message = "<h1>Notifikasi Forget Password User</h1>
                <p>Tidak untuk dibalas karena ini hanya pemberitahuan</p>
                <p>Link Forget Password : {$linkSurat}</p>";
                $title = 'Notifikasi Forget Password Si-JanTan';
                $this->sendEmail($title, $message, $username);
                $dataArray = [
                    'msg' => 'Register Data User',
                    'status' => ResponseInterface::HTTP_OK
                ];
            }else{
                $dataArray = [
                    'msg' => 'Email Tidak Terdaftar',
                    'status' => ResponseInterface::HTTP_OK,
                    'result' => []
                ];
            }

        } catch (\Exception $th) {
            $dataArray = [
                'msg' => $th->getMessage(),
                'status' => ResponseInterface::HTTP_BAD_REQUEST
            ];
        }
        return $this->respond($dataArray);
    }

}
