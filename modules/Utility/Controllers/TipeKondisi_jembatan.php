<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Yusda Helmani
 */

namespace Modules\Utility\Controllers;

use App\Controllers\BaseController;
use Modules\Utility\Models as Utility;

class TipeKondisi_jembatan extends BaseController
{
    private $module = 'Modules\Utility\Views', $moduleUrl = 'utility/tipekondisi_jembatan';

    public function __construct()
    {
        parent::__construct();
        $this->M_JembatanTipeKondisi = new Utility\Model_tipekondisi_jembatan();
    }

    function index()
    {
        $record['content'] = $this->module . '\jembatan\tipekondisi\index';
        $record['moduleUrl'] = $this->moduleUrl;
        $record['getTipeKondisi'] = $this->M_JembatanTipeKondisi->findAll();
        $record['ribbon'] = ribbon('Utility', 'Tipe Kondisi Jembatan');
        $this->render($record);
    }

    function addData()
    {
        cekCsrfToken($this->post('token'));
        $id = $this->post('tipekondisi_id');
        $data = [
            'tipekondisi_nama' => $this->post('tipekondisi_nama'),
        ];
        try {
            $query = $id ? $this->M_JembatanTipeKondisi->update($id, $data) : $this->M_JembatanTipeKondisi->insert($data);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Input Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        $this->flashdata($msg['ket'], $msg['status']);
        return redirect()->back();
    }

    function deleteData()
    {
        $id = $this->post('id');
        try {
            $query = $this->M_JembatanTipeKondisi->delete($id);
            $status = $query ? true : false;
            $msg = ['status' => $status, 'ket' => 'Berhasil Menghapus Data'];
        } catch (\Exception $th) {
            $msg = ['status' => false, 'ket' => $th->getMessage()];
        }
        echo json_encode($msg);
    }

    private function _formValidation()
    {
        $rules = [
            'kategori_nama' => 'required',
            'kategori_inisial' => 'required',
        ];
        if ($this->validate($rules) === false) {
            $this->flashdata('Validasi Gagal', false);
            return redirect()->back()->withInput('validation', $this->validasi);
        }
    }


}
