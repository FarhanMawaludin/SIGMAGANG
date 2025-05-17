<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;


class PengajuanMahasiswaController extends Controller
{
    public function index(){
        $activemenu='pengajuan';
        return view('mahasiswa.pengajuan.index',[
            'activemenu'=>$activemenu
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'lowongan_id'=>'required',
            'mahasiswa_id'=>'required',
        ]);
        $pengajuan = Pengajuan::create([
            'lowongan_id'=>$request->lowongan_id,
            'mahasiswa_id'=>$request->mahasiswa_id,
        ]);
        return redirect()->route('mahasiswa.pengajuan.index')->with('success', 'Pengajuan berhasil dibuat');
    }
}
