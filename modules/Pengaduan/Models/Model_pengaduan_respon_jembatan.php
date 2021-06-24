<?php

namespace Modules\Pengaduan\Models;

use CodeIgniter\Model;

class Model_pengaduan_respon_jembatan extends Model
{
    protected $table = 'pengaduan_jembatan_respon';
    protected $primaryKey = 'respon_id';
    protected $allowedFields = ['tiket_kode', 'respon_ket', 'respon_tgl', 'session'];
}
