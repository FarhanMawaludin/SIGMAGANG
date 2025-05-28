<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class MahasiswaDosenController extends Controller
{
    public function index(Request $request)
    {
        $activemenu = 'mahasiswa';
        $category = $request->input('category', 'all');
        $search = $request->input('search');

        $dosen = auth()->user()->dosen;

        // Cek apakah user punya data dosen
        if (!$dosen) {
            $emptyPagination = new LengthAwarePaginator([], 0, 10);
            return view('dosen.mahasiswa.index', [
                'activemenu' => $activemenu,
                'pengajuan' => $emptyPagination, // paginator kosong
                'mahasiswa' => $emptyPagination,
                'category' => $category,
                'search' => $search,
            ]);
        }

        // Jika dosen ada, jalankan query seperti biasa
        $query = Pengajuan::with(['mahasiswa.user', 'lowongan'])
            ->where('dosen_id', $dosen->id)
            ->whereHas('lowongan', function ($q) {
                $q->whereNotNull('id');
            });

        if ($category !== 'all') {
            $query->where('status', $category);
        }

        if ($search) {
            $query->whereHas('mahasiswa.user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $pengajuan = $query->latest()->paginate(10);

        return view('dosen.mahasiswa.index', [
            'activemenu' => $activemenu,
            'pengajuan' => $pengajuan,
            'mahasiswa' => $pengajuan,
            'category' => $category,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $activemenu = 'mahasiswa';
        $user = Auth::user();
        $pengajuan = Pengajuan::with(['mahasiswa.user', 'lowongan'])
            ->where('dosen_id', auth()->user()->dosen->id)
            ->where('id', $id)
            ->firstOrFail();
        return view('dosen.mahasiswa.show', [
            'user' => $user,
            'activemenu' => $activemenu,
            'pengajuan' => $pengajuan,
        ]);
    }
}
