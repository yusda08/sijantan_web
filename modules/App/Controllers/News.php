<?php

namespace Modules\App\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;

class News extends BaseController
{
    private $module = 'Modules\App\Views', $moduleUrl = 'aplikasi/news';

    public function __construct()
    {
        parent::__construct();
        $this->M_News = new App\Model_news();
    }

    function index()
    {
        $record['content'] = $this->module . '\news\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getNews'] = $this->M_News->findAll();
        $record['ribbon'] = ribbon('Aplikasi', 'Profile Unit');
        $this->render($record);
    }


    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('news_id');
        $rules = ['news_judul' => 'required', 'news_ket' => 'required'];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
        $data = ['news_judul' => $this->post('news_judul'), 'news_ket' => $this->post('news_ket'), 'news_tgl' => date('Y-m-d H:i:s')];;
        try {
            $que = $id ? $this->M_News->update($id, $data) : $this->M_News->insert($data);
            $status = $que ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Berita'];
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
            $query = $this->M_News->delete($id);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Delete Data Berita'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }


}
