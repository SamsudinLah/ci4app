<?php

namespace App\Models;

use CodeIgniter\Model;

class BacaModel extends Model
{
    protected $table      = 'tb_baca';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nmr_baca', 'tgl_baca', 'tgl_selesai'];

    public function getAll()
    {
        return $this->db->table('tb_baca')
            ->join('orang', 'orang.id=tb_baca.id', 'left')
            ->orderBy('id_baca', 'ASC')
            ->get()->getResultArray();
    }
}
