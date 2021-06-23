<?php

namespace Modules\App\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;

class Banner extends BaseController
{
    private $module = 'Modules\App\Views', $moduleUrl = 'aplikasi/banner';

    public function __construct()
    {
        parent::__construct();
        $this->M_Banner = new App\Model_banner();
    }

    function index()
    {
        $record['content'] = $this->module . '\banner\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getBanner'] = $this->M_Banner->findAll();
        $record['ribbon'] = ribbon('Aplikasi', 'Banner');
        $this->render($record);
    }


    function addData()
    {
        cekCsrfToken($this->post('token'));
        $rules = [
            'file' => [
                'rules' => 'is_image[file]',
                'errors' => [
                    'is_image' => 'Yang dipilih bukan Format Image'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $error = $this->validasi->getErrors();
            $this->flashdata($error['file'], false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
        try {
            $path = "public/uploads/img/banner/";
            if (!file_exists(ROOTPATH . $path)) {
                mkdir(ROOTPATH . $path, 0777, true);
            }
            $file = $this->file('file');
            $data['banner_judul'] = $this->post('banner_judul');
            $data['banner_ket'] = $this->post('banner_ket');
            $data['foto_name'] = $file->getRandomName();
            $data['foto_path'] = $path;
            $file->move(ROOTPATH .$path, $data['foto_name']);
            $que = $this->M_Banner->insert($data);
            $status = $que ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Banner'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function deleteData()
    {
        $this->cekNotIsAjax();
        $id = $this->post('id');
        try {
            $query = $this->M_Banner->delete($id);
            $status = $query ? true : false;
            if($status){
                unlink(ROOTPATH . $this->post('foto_path') . $this->post('foto_name'));
            }
            $msg = ['status' => $status, 'ket' => 'Delete Data Berita'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }


}
