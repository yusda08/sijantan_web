<?php

namespace Modules\Pengaduan\Models;

use CodeIgniter\Model;

class Model_pengaduan_jembatan extends Model
{
    protected $table = 'pengaduan_jembatan';
    protected $primaryKey = 'tiket_kode';

    public function getResource(string $search = null)
    {
        $build = $this->_query();
        if ($search) {
            $build->groupStart()
                ->like('nama', $search)
                ->orLike('pengadu_nama', $search)
                ->orLike('tiket_kode', $search)
                ->groupEnd();
        }
        return $build;
    }

    public function getPengaduanJembatan(array $where = null)
    {
        $build = $this->_query();
        if ($where) {
            $this->where($where);
        }
        return $build->get();
    }

    private function _query()
    {
        return $this->db->table($this->table . ' a')
            ->select('a.*, b.nomor, b.nama, c.nama_user, c.email')
            ->join('data_jembatan b', 'a.jembatan_id=b.jembatan_id','left')
            ->join('user c ', 'c.kd_user=a.kd_user','left');
    }

}
