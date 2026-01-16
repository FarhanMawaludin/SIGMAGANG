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
        $todayCount = User::where('role', 'mahasiswa')
            ->whereDate('created_at', today())
            ->count();

        $yesterdayCount = User::where('role', 'mahasiswa')
            ->whereDate('created_at', today()->subDay())
            ->count();

        $user_increase = $todayCount - $yesterdayCount;

        // lowongan
        $lowongan = Lowongan::all();
        $lowongan_count = $lowongan->count();
        $todayCount = Lowongan::whereDate('created_at', today())->count();
        $yesterdayCount = Lowongan::whereDate('created_at', today()->subDay())->count();
        $lowongan_increase = $todayCount - $yesterdayCount;

        // pengajuan
        $query = Pengajuan::with(['mahasiswa.user', 'mahasiswa.prodi', 'lowongan'])->where('status', 'pending');
        $pengajuan = $query->paginate(5);
        $pengajuan_count = $query->count();
        $pending_count = Pengajuan::where('status', 'pending')->count();
        $accepted_count = Pengajuan::where('status', 'accepted')->count();
        $rejected_count = Pengajuan::where('status', 'rejected')->count();
        $todayCount = Pengajuan::whereDate('created_at', today())->count();
        $yesterdayCount = Pengajuan::whereDate('created_at', today()->subDay())->count();
        $pengajuan_increase = $todayCount - $yesterdayCount;

        // statistik
        $accepted_per_year = Pengajuan::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->whereIn('status', ['accepted', 'completed'])
            ->groupByRaw('YEAR(created_at)')
            ->orderBy('year')
            ->get();

        $years = $accepted_per_year->pluck('year')->toArray();
        $totals = $accepted_per_year->pluck('total')->toArray();

        // perusahaan
        $perusahaan = Perusahaan::all();
        $perusahaan_count = $perusahaan->count();
        $todayCount = Perusahaan::whereDate('created_at', today())->count();
        $yesterdayCount = Perusahaan::whereDate('created_at', today()->subDay())->count();
        $perusahaan_increase = $todayCount - $yesterdayCount;

        // tambahan: statistik bulanan berdasarkan tahun terpilih
        $selectedYear = request('year') ?? null;

        $monthlyData = [];
        if ($selectedYear) {
            $monthlyAcceptedPengajuan = Pengajuan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->whereIn('status', ['accepted', 'completed'])
                ->whereYear('created_at', $selectedYear)
                ->groupByRaw('MONTH(created_at)')
                ->orderBy('month')
                ->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $monthlyData[] = $monthlyAcceptedPengajuan[$i] ?? 0;
            }
        }

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
            'user_increase' => $user_increase,
            'lowongan' => $lowongan,
            'lowongan_increase' => $lowongan_increase,
            'pengajuan' => $pengajuan,
            'pengajuan_increase' => $pengajuan_increase,
            'perusahaan' => $perusahaan,
            'perusahaan_increase' => $perusahaan_increase,
            'years' => $years,
            'totals' => $totals,
            'monthlyData' => $monthlyData,
            'selectedYear' => $selectedYear,
            'activemenu' => $activemenu
        );

        return view('dashboard', $data);
    }

    public function dosen()
    {
        $activemenu = 'dashboard';
        $user = Auth::user();
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;

        // Validasi dosen pembimbing
        if (!$dosen) {
            $emptyPagination = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);

            return view('dosen.monitoring.index', compact('activemenu'))
                ->with('pengajuanList', $emptyPagination);
        }

        $pengajuanList = Pengajuan::with(['mahasiswa.user', 'lowongan.perusahaan', 'lowongan.jenisMagang'])
            ->where('dosen_id', $dosen->id)
            ->where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $logMingguan = \App\Models\LogMingguan::with(['pengajuan.mahasiswa.user'])
            ->whereHas('pengajuan.mahasiswa', function ($q) {
                $q->where('dosen_id', Auth::id());
            })
            ->latest()
            ->paginate(10);


        return view('dosen-dashboard', [
            'activemenu' => $activemenu,
            'pengajuan' => $pengajuanList,
            'logMingguan' => $logMingguan
        ]);
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
