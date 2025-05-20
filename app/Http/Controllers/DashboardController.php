<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pengajuan;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_count = User::where('role', 'mahasiswa')->count();
        $lowongan_count = Lowongan::count();
        $pengajuan_count = Pengajuan::count();
        $perusahaan_count = Perusahaan::count();
        $activemenu = 'dashboard';
        $data = array(
            'user_count' => $user_count,
            'lowongan_count' => $lowongan_count,
            'pengajuan_count' => $pengajuan_count,
            'perusahaan_count' => $perusahaan_count,
            'activemenu' => $activemenu

        );
        return view('dashboard', $data);
    }
    public function dosen()
    {
        $activemenu = 'dashboard';
        $data = array(

            'activemenu' => $activemenu
        );
        return view('dosen-dashboard', $data);
    }


    public function mahasiswa(Request $request)
    {
        $activemenu = 'dashboard';

        $search = $request->search;
        $user = Auth::user();
        $category = $request->category ?? 'all';
        $mahasiswa = $user->mahasiswa;

        $query = Pengajuan::with(['mahasiswa.user', 'lowongan'])
            ->where('status', 'pending')
            ->whereHas('mahasiswa', function ($q) {
                $q->where('user_id', auth()->id());
            
            });

        if ($search) {
            $query->whereHas('mahasiswa.user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($category !== 'all') {
            $query->where('status', $category);
        }

        $pengajuan = $query->paginate(10);

        return view('mahasiswa-dashboard', [
            'activemenu' => $activemenu,
            'pengajuan' => $pengajuan,
            'mahasiswa' => $mahasiswa
        ]);
    }

    // public function mahasiswa()
    // {
    //     $activemenu = 'dashboard';
    //     $data = array(

    //         'activemenu' => $activemenu
    //     );
    //     return view('mahasiswa-dashboard', $data);
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
