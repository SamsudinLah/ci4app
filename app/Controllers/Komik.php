<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\HTTP\Request;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        // $komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];


        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];
        //jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan.');
        }

        return view('komik/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required[komik.penulis]',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required[komik.penerbit]',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();

            // return redirect()->to('/Komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/Komik/create')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah tidak ada file yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpeg';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke  folder img
            $fileSampul->move('img', $namaSampul);
        }

        //insert data ke database
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('addsuccess', 'Data berhasil ditambahkan.');

        return redirect()->to('/komik');
    }
    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);
        // cek jika gambarnya default.jpeg
        if ($komik['sampul'] != 'default.jpeg') {
            // hapus gambar 
            unlink('img' . $komik['sampul']);
        }

        $this->komikModel->delete($id);
        session()->setFlashdata('removed', 'Data berhasil dihapus.');
        return redirect()->to('/komik');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];
        return view('komik/edit', $data);
    }
    public function update($id)
    {
        // cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required[komik.penulis]',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required[komik.penerbit]',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/Komik/edit/' . $this->request->getVar('slug'))->withInput();
        } {

            $fileSampul = $this->request->getFile('sampul');

            // cek gambar, apakah tetap gambar lama
            if ($fileSampul->getError() == 4) {
                $namaSampul = $this->request->getVar('sampulLama');
                // gambar default tidak hilang
            } else if ($this->request->getVar('sampulLama') == 'default.jpeg') {
                // generate nama file random
                $namaSampul = $fileSampul->getRandomName();
                // pindahkan gambar
                $fileSampul->move('img', $namaSampul);
            } else {
                // generate nama file random
                $namaSampul = $fileSampul->getRandomName();
                // pindahkan gambar
                $fileSampul->move('img', $namaSampul);
                // hapus file lama
                unlink('img' . $this->request->getVar('sampulLama'));
            }

            $slug = url_title($this->request->getVar('judul'), '-', true);
            $this->komikModel->save([
                'id' => $id,
                'judul' => $this->request->getVar('judul'),
                'slug' => $slug,
                'penulis' => $this->request->getVar('penulis'),
                'penerbit' => $this->request->getVar('penerbit'),
                'sampul' => $namaSampul
            ]);

            session()->setFlashdata('updated', 'Data berhasil diubah.');

            return redirect()->to('/komik');
        }
    }
}
