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

namespace Modules\Jalan\Controllers;

use App\Controllers\BaseController;
use Modules\Jalan\Models as Jalan;
use Modules\Utility\Models as Utility;

class Data_jalan extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->M_Jalan = new Jalan\Model_jalan();
        $this->M_Koordinast = new Jalan\Model_koordinat_jalan();
        $this->M_JalanKondisi = new Jalan\Model_kondisi_jalan();
        $this->M_JalanPermukaan = new Jalan\Model_permukaan_jalan();
        $this->M_JalanLebar = new Jalan\Model_lebar_jalan();
        $this->M_UtiKondisi = new Utility\Model_kondisi_jalan();
        $this->M_UtiPermukaan = new Utility\Model_permukaan_jalan();
        $this->M_UtiLebar = new Utility\Model_lebar_jalan();
    }

    function loadDataTable()
    {
        $this->cekNotIsAjax();
        $start = $this->post('start');
        $length = $this->post('length');
        $search = $this->post('search[value]');
        $getData = $this->M_Jalan->getResource($search)->orderBy('ruas_no')->get()->getResultArray();
        foreach ($getData as $i => $row) {
            $getData[$i]['ruas_no'] = sprintfNumber($row['ruas_no'], 3);
            $getData[$i]['ruas_panjang'] = numberFormat($row['ruas_panjang']);
            $getData[$i]['klasifikasi_nama'] = $row['klasifikasi_nama'] . ' (' . $row['klasifikasi_inisial'] . ')';
        }
        return $this->respond([
            'draw' => $this->post('draw'),
            'recordsTotal' => $this->M_Jalan->getResource()->countAllResults(),
            'recordsFiltered' => $this->M_Jalan->getResource($search)->countAllResults(),
            'data' => $getData,
        ]);
    }

    function loadDataJalan($jalan_id = null)
    {
        $getData = $jalan_id ? $this->M_Jalan->getDataJalan(['jalan_id' => $jalan_id])->getRowArray() : $this->M_Jalan->getDataJalan()->getResultArray();
        return json_encode($getData);
    }

    function loadDataKoordinat()
    {
        $jalan_id = $this->get('jalan_id');
        $getJalan = $this->M_Koordinast->where(['jalan_id' => $jalan_id])->findAll();
        echo json_encode($getJalan);
    }

    function loadKondisiJalan($jalan_id = null, $kondisi_id = null)
    {
        $arrayWhere = $jalan_id ? ['jalan_id' => $jalan_id] : '';
        $getData = $kondisi_id ? $this->M_UtiKondisi->where(['kondisi_id' => $kondisi_id])->findAll() : $this->M_UtiKondisi->findAll();
        $getKondisi = $this->M_JalanKondisi->getKondisi($arrayWhere)->getResultArray();
        $panjangTtl = 0;
        $dataJalan = (array)json_decode($this->loadDataJalan());
        foreach ($dataJalan as $jln) {
            $panjangTtl += $jln->ruas_panjang;
        }
        foreach ($getData as $i => $row_kon) {
            $panjang = 0;
            $ket = '';
            foreach ($getKondisi as $item) {
                if ($item['kondisi_id'] == $row_kon['kondisi_id']) {
                    $panjang += $item['panjang'];
                    $ket = $item['keterangan'];
                }
            }
            $persen = @($panjang/$panjangTtl) * 100;
            $getData[$i]['panjang'] = $panjang;
            $getData[$i]['panjang_ttl'] = $panjangTtl;
            $getData[$i]['persen'] = numberFormat($persen, 2);
            $getData[$i]['keterangan'] = $ket;
        }
//        $getData['panjang_ttl'] = $panjangTtl;
        $getData = $kondisi_id ? $getData[0] : $getData;
        return json_encode($getData);
    }

    function loadPermukaanJalan($jalan_id = null, $permukaan_id = null)
    {
        $arrayWhere = $jalan_id ? ['jalan_id' => $jalan_id] : '';
        $getData = $permukaan_id ? $this->M_UtiPermukaan->where(['permukaan_id' => $permukaan_id])->findAll() : $this->M_UtiPermukaan->findAll();
        $getPermukaan = $this->M_JalanPermukaan->getPermukaan($arrayWhere)->getResultArray();
        foreach ($getData as $i => $row) {
            $panjang = 0;
            $ket = '';
            foreach ($getPermukaan as $item) {
                if ($item['permukaan_id'] == $row['permukaan_id']) {
                    $panjang = $item['panjang'];
                    $ket = $item['keterangan'];
                }
            }
            $getData[$i]['panjang'] = $panjang;
            $getData[$i]['keterangan'] = $ket;
        }
        $getData = $permukaan_id ? $getData[0] : $getData;
        return json_encode($getData);
    }

    function loadLebarJalan($jalan_id = null, $lebar_id = null)
    {
        $arrayWhere = $jalan_id ? ['jalan_id' => $jalan_id] : '';
        $getData = $lebar_id ? $this->M_UtiLebar->where(['lebar_id' => $lebar_id])->findAll() : $this->M_UtiLebar->findAll();
        $getLebar = $this->M_JalanLebar->getLebar($arrayWhere)->getResultArray();
        foreach ($getData as $i => $row) {
            $panjang = 0;
            $ket = '';
            foreach ($getLebar as $item) {
                if ($item['lebar_id'] == $row['lebar_id']) {
                    $panjang = $item['panjang'];
                    $ket = $item['keterangan'];
                }
            }
            $getData[$i]['panjang'] = $panjang;
            $getData[$i]['keterangan'] = $ket;
        }
        $getData = $lebar_id ? $getData[0] : $getData;
        return json_encode($getData);
    }

}
