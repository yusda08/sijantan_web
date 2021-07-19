<?php

namespace Modules\Pengaduan\Models;

use CodeIgniter\Model;

class Model_pengaduan_jalan extends Model
{
    protected $table = 'pengaduan_jalan';
    protected $primaryKey = 'tiket_kode';

    public function getResource(string $search = null)
    {
        $build = $this->_query();
        if ($search) {
            $build->groupStart()
                ->like('ruas_nama', $search)
                ->orLike('pengadu_nama', $search)
                ->orLike('tiket_kode', $search)
                ->groupEnd();
        }
        return $build;
    }

    public function getPengaduanJalan(array $where = null)
    {
        $build = $this->_query();
        if ($where) {
            $build->where($where);
        }
        return $build->get();
    }

    private function _query()
    {
        return $this->db->table($this->table . ' a')
            ->select('a.*, b.ruas_no, b.ruas_nama, b.ruas_status, c.nama_user, c.email')
            ->join('data_jalan b', 'a.jalan_id=b.jalan_id', 'left')
            ->join('user c ', 'c.kd_user=a.kd_user','left');
    }

}
