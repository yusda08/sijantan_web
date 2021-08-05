<?php

namespace Modules\Pengaduan\Models;

use CodeIgniter\Model;

class Model_pengaduan_jalan extends Model
{
    protected $table = 'pengaduan_jalan';
    protected $primaryKey = 'tiket_kode';

    public function getResource(string $search = null, array $where = [])
    {
        $build = $this->_query();
        if ($search) {
            $build->groupStart()
                ->like('jalan_nama', $search)
                ->orLike('pengadu_nama', $search)
                ->orLike('tiket_kode', $search)
                ->groupEnd();
        }
        if ($where) {
            $build->where($where);
        }
        return $build;
    }

    private function _query()
    {
        return $this->db->table($this->table . ' a')
            ->select('a.*, c.nama_user, c.email')
            ->join('user c ', 'c.kd_user=a.kd_user');
    }

    public function getPengaduanJalan(array $where = null)
    {
        $build = $this->_query();
        if ($where) {
            $build->where($where);
        }
        return $build->get();
    }

}
