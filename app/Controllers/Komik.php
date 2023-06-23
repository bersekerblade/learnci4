<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{

    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {

        //$komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Komik | Sannin Studio',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Komik | Sannin Studio',
            'komik' => $this->komikModel->getKomik($slug)
        ];


        // jika data tidak ada
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' Tidak ditemukan.');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {

        // session();
        $data = [
            'title' => 'Tambah Data Komik | Sannin Studio',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {

        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' =>  'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} Komik harus diisi!',
                    'is_unique' => '{field} sudah pernah digunakan'
                ]
            ],

            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Komik harus diisi!'
                ]
            ],

            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Komik harus diisi!'
                ]
            ],

            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran tidak boleh lebih dari 1 mb',
                    'mime_in' => 'format hanya jpg jpeg dan png',
                    'is_image' => 'harus gambar'
                ]
            ]

        ])) {

            //$validation = \Config\Services::validation();
            //return redirect()->back()->withInput()->with('validation', $validation);

            return redirect()->to('/komik/create')->withInput();
        }

        //ambil sampul
        $fileSampul = $this->request->getFile('sampul');

        //apakah ada file gambar yg diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();

            //pindah sampul ke folder public img
            $fileSampul->move('img', $namaSampul);

            //ambil nama file sampul untuk disimpan di db menggunakan nama file asli
            //$namaSampul = $fileSampul->getName();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        //cari gambar berdasrkan id
        $komik = $this->komikModel->find($id);

        //cek gambar default
        if ($komik['sampul'] != 'default.jpg') {
            //hapus gambar di dalam folder img
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {

        //cek judul komik lama
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        //validasi update
        if (!$this->validate([
            'judul' => [
                'rules' =>  $rule_judul,
                'errors' => [
                    'required' => '{field} Komik harus diisi!',
                    'is_unique' => '{field} sudah pernah digunakan'
                ]
            ],

            'penulis' => [
                'rules' =>  'required[komik.penulis]',
                'errors' => [
                    'required' => '{field} Komik harus diisi!'
                ]
            ],

            'penerbit' => [
                'rules' =>  'required[komik.penerbit]',
                'errors' => [
                    'required' => '{field} Komik harus diisi!'
                ]
            ],

            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran tidak boleh lebih dari 1 mb',
                    'mime_in' => 'format hanya jpg jpeg dan png',
                    'is_image' => 'harus gambar'
                ]
            ]

        ])) {

            return redirect()->to('komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        //cek gambar, apa tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate file random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            //hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah!');

        return redirect()->to('/komik');
    }
}
