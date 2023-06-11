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
        $data = [
            'title' => 'Tambah Data Komik | Sannin Studio'
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');

        return redirect()->to('/komik');
    }
}
