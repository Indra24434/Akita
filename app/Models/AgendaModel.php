<?php

namespace App\Models;
use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table = 'agenda';

    protected $allowedFields = ['tanggal', 'jam', 'kegiatan', 'pic', 'tempat'];

    protected $useTimestamps = true;
}
