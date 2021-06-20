<?php

namespace Modules\App\Controllers;

use App\Controllers\BaseController;
use Modules\App\Models as App;

class Running_text extends BaseController
{
    private $module = 'Modules\App\Views', $moduleUrl = 'aplikasi/running_text';

    public function __construct()
    {
        parent::__construct();
        $this->M_RunText = new App\Model_running_text();
    }

    function index()
    {
        $record['content'] = $this->module . '\running_text\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getRunningText'] = $this->M_RunText->findAll();
        $record['ribbon'] = ribbon('Aplikasi', 'Running Text');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $run_id = $this->post('run_id');
        $data = [
            'run_ket' => $this->post('run_ket'),
            'status_aktif' => $run_id ? $this->post('status_aktif') : 0,
            'run_tgl' => date("Y-m-d H:i:s"),
        ];
        try {
            $que = $run_id ? $this->M_RunText->update($run_id, $data) : $this->M_RunText->insert($data);
            $status = $que ? true : false;
            $msg = ['status' => $status, 'ket' => 'Input Data Running Text'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function updateStatus()
    {
        $this->cekNotIsAjax();
        $run_id = $this->post('id');
        $data = ['status_aktif' => 1, 'run_tgl' => date("Y-m-d H:i:s")];
        try {
            $que = $this->update_where(['status_aktif' => 1], 'app_running_text', ['status_aktif' => 0]);
            if ($que) {
                $query = $this->update_where(['run_id' => $run_id], 'app_running_text', $data);
                $status = $query ? true : false;
                $msg = ['status' => $status, 'ket' => 'Update Status Running Text'];
            }
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

    function deleteData()
    {
        $this->cekNotIsAjax();
        $run_id = $this->post('id');
        try {
            $query = $this->M_RunText->delete($run_id);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Delete Data Running Text'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        return json_encode($msg);
    }

}
