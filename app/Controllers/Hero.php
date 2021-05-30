<?php

namespace App\Controllers;

class Hero extends BaseController
{
    public function index()
    {
        return view('hero/index');
    }
}
