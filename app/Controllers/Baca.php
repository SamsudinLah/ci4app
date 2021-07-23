<?php

namespace App\Controllers;

use App\Models\BacaModel;
use CodeIgniter\HTTP\Request;

class Baca extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->bacaModel = new BacaModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Baca',
            'baca' => $this->bacaModel->getAll()
        ];
        return view('/baca/index', $data);
    }
}
