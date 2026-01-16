<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\BidangPerusahaan;
use Illuminate\Http\Request;
use Storage;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activemenu = 'perusahaan';

        // Ambil input pencarian dan kategori
        $search = $request->input('search');
        $category = $request->input('category', 'all');

        // Ambil semua data bidang perusahaan
        $bidangPerusahaans = BidangPerusahaan::all();

        // Query untuk mengambil data perusahaan
        $query = Perusahaan::with('bidangPerusahaan'); // Relasi ke BidangPerusahaan

        // Jika ada search input
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Jika kategori tidak 'all', filter berdasarkan nama bidang perusahaan
        if ($category !== 'all') {
            $query->whereHas('bidangPerusahaan', function ($q) use ($category) {
                $q->where('id', $category);  // Filter berdasarkan ID bidang perusahaan
            });
        }

        // Ambil hasil query dengan pagination
        $perusahaan = $query->paginate(10)->appends([
            'search' => $search,
            'category' => $category
        ]);
        // Kembalikan hasil ke view
        return view('admin.perusahaan.index', compact('activemenu', 'perusahaan', 'search', 'category', 'bidangPerusahaans'));
    }



    public function create()
    {
        $activemenu = 'perusahaan';
        $bidangs = BidangPerusahaan::all();

        return view('admin.perusahaan.create', compact('activemenu', 'bidangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:perusahaan,email',
            'website' => 'nullable|url',
            'bidang_perusahaan_id' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('logo_perusahaan', 'public');
        }

        Perusahaan::create($validated);

        return redirect()->route('admin.perusahaan.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $activemenu = 'perusahaan';
        $perusahaan = Perusahaan::with('bidangPerusahaan')->findOrFail($id);
        return view('admin.perusahaan.show', [
            'activemenu' => $activemenu,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $activemenu = 'perusahaan';
        $bidangs = BidangPerusahaan::all();

        return view('admin.perusahaan.edit', compact('perusahaan', 'activemenu', 'bidangs'));
    }

    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|unique:perusahaan,email,' . $perusahaan->id,
            'website' => 'nullable|url',
            'bidang_perusahaan_id' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($perusahaan->foto) {
                Storage::disk('public')->delete($perusahaan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('logo_perusahaan', 'public');
        }

        $perusahaan->update($validated);

        return redirect()->route('admin.perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        if ($perusahaan->foto) {
            Storage::disk('public')->delete($perusahaan->foto);
        }
        $perusahaan->delete();

        return redirect()->route('admin.perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
    /**
     * Show the form for creating a new resource.
     */
}
