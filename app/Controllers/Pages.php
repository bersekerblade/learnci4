<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Sannin Studio'
        ];
        // echo view('layout/header', $data);
        return view('pages/home', $data);
        // echo view('layout/footer');
    }

    public function about()
    {
        $data = [
            'title' => 'About | Sannin Studio'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Sannin Studio',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. Diponegoro',
                    'telepon' => '089878676887'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Dipo',
                    'telepon' => '089878676889'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
