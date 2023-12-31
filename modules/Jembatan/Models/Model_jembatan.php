<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_setting
 *
 * @author Yusda Helmani
 */

namespace Modules\Jembatan\Models;

use CodeIgniter\Model;

class Model_jembatan extends Model
{
    protected $table = 'data_jembatan';
    protected $primaryKey = 'jembatan_id';
    protected $allowedFields = ['nomor', 'nama', 'kecamatan', 'ruas', 'sta'];

    public function getResource(string $search = null)
    {
        $build = $this->_query();
        if ($search) {
            $build->groupStart()
                ->like('nama', $search)
                ->orLike('ruas', $search)
                ->orLike('kecamatan', $search)
                ->groupEnd();
        }
        return $build;
    }

    public function getDataJembatan($arrayWhere = null)
    {
        $build = $this->_query();
        if($arrayWhere){
            $build->where($arrayWhere);
        }
        return $build->get();
    }
    public function getTipeKondisiJembatan($arrayWhere = null)
    {
        $build = $this->db->table($this->table.' a')->select('c.tipekondisi_id, c.tipekondisi_nama, b.tipe, d.kondisi_nama, b.tahun, b.kondisi_id')
                ->join('data_jembatan_tipekondisi b', 'a.jembatan_id = b.jembatan_id')
                ->join('uti_jembatan_tipekondisi c', 'c.tipekondisi_id = b.tipekondisi_id')
                ->join('uti_jembatan_kondisi d', 'd.kondisi_id = b.kondisi_id', 'left');
        if($arrayWhere){
            $build->where($arrayWhere);
        }
        return $build->get();
    }
    public function getSpesifikasiJembatan($arrayWhere = null)
    {
        $build = $this->db->table($this->table.' a')->select('b.panjang, b.lebar, b.jumlah_bentang, c.kondisi_nama, b.tahun')
                ->join('data_jembatan_spesifikasi b', 'a.jembatan_id = b.jembatan_id','left')
                ->join('uti_jembatan_kondisi c', 'c.kondisi_id = b.kondisi_id','left');
        if($arrayWhere){
            $build->where($arrayWhere);
        }
        return $build->get();
    }

    private function _query()
    {
        $build = $this->db->table($this->table . ' a')->select('a.jembatan_id, a.nomor, a.nama, a.kecamatan, a.ruas, a.sta, a.latitude, a.longitude, b.tahun, b.kondisi_id, b.panjang, 
b.lebar, b.jumlah_bentang, c.kondisi_nama')
                ->join('data_jembatan_spesifikasi b', 'a.jembatan_id = b.jembatan_id','left')
                ->join('uti_jembatan_kondisi c', 'c.kondisi_id = b.kondisi_id','left');
        return $build;
    }
    
    public function getKondisiJembatan($tahun = null){
        $build = $this->db->table($this->table.' a')->select('COUNT(b.kondisi_id) count_kondisi, c.kondisi_nama, c.kondisi_id')
                ->join('data_jembatan_spesifikasi b', 'a.jembatan_id = b.jembatan_id AND b.tahun = '.$tahun)
                ->join('uti_jembatan_kondisi c', 'c.kondisi_id = b.kondisi_id', 'left')
                ->groupby('b.kondisi_id');
        return $build->get();
    }
    public function getKategoriJembatan($tahun = null){
        $build = $this->db->table($this->table.' a')->select('COUNT(d.kategori_jembatan_id) count_kategori, d.nm_kategori,  d.kategori_jembatan_id')
                ->join('data_jembatan_spesifikasi b', 'a.jembatan_id = b.jembatan_id AND b.tahun = '.$tahun)
                ->join('uti_jembatan_kondisi c', 'c.kondisi_id = b.kondisi_id', 'left')
                ->join('uti_jembatan_kategori d', 'c.kategori_jembatan_id = d.kategori_jembatan_id', 'left')
                ->groupby('d.kategori_jembatan_id');
        return $build->get();
    }

}
