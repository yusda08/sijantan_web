<?php

namespace Modules\Pengaduan\Models;

use CodeIgniter\Model;

class Model_pengaduan_respon_jalan extends Model
{
    protected $table = 'pengaduan_jalan_respon';
    protected $primaryKey = 'respon_id';
    protected $allowedFields = ['tiket_kode', 'respon_ket', 'respon_tgl', 'session'];
}
