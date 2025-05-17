<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilDosenController extends Controller
{
    public function index()
    {
        $activemenu = 'profil';
        return view('dosen.profil.index', [
            'activemenu' => $activemenu
        ]);
    }
}
