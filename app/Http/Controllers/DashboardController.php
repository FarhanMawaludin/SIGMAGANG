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
        // user
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        $user_count = $mahasiswa->count();

        // lowongan
        $lowongan = Lowongan::all();
        $lowongan_count = $lowongan->count();

        // pengajuan
        $query = Pengajuan::with(['mahasiswa.user', 'mahasiswa.prodi', 'lowongan'])->where('status', 'pending');
        $pengajuan = $query->paginate(5);
        $pengajuan_count = $query->count();
        $pending_count = Pengajuan::where('status', 'pending')->count();
        $accepted_count = Pengajuan::where('status', 'accepted')->count();
        $rejected_count = Pengajuan::where('status', 'rejected')->count();

        // statistik
        $accepted_per_year = Pengajuan::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->where('status', 'accepted')
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year')
            ->get();

        $years = $accepted_per_year->pluck('year')->toArray();
        $totals = $accepted_per_year->pluck('total')->toArray();

        // perusahaan
        $perusahaan = Perusahaan::all();
        $perusahaan_count = $perusahaan->count();

        $activemenu = 'dashboard';

        $data = array(
            'user_count' => $user_count,
            'lowongan_count' => $lowongan_count,
            'pengajuan_count' => $pengajuan_count,
            'pending_count' => $pending_count,
            'accepted_count' => $accepted_count,
            'rejected_count' => $rejected_count,
            'perusahaan_count' => $perusahaan_count,
            'mahasiswa' => $mahasiswa,
            'lowongan' => $lowongan,
            'pengajuan' => $pengajuan,
            'perusahaan' => $perusahaan,
            'years' => $years,
            'totals' => $totals,
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
