<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaDosenController extends Controller
{
    public function index()
    {
        $activemenu = 'mahasiswa';
        return view('dosen.mahasiswa.index', [
            'activemenu' => $activemenu
        ]);
    }
}
