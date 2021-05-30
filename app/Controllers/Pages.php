<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('pages/home', $data);
    }


    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        return view('pages/about', $data);
    }


    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. Kotaanyar',
                    'kota' => 'Probolinggo'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Paiton',
                    'kota' => 'Situbondo'
                ]

            ]
        ];
        return view('pages/contact', $data);
    }
}
