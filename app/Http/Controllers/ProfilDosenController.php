<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DosenPembimbing;

class ProfilDosenController extends Controller
{
    /**
     * Tampilkan halaman profil dosen
     */
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosen()->with('prodi')->first();

        return view('dosen.profil.index', [
            'user' => $user,
            'dosen' => $dosen,
            'activemenu' => 'profil',
        ]);
    }

    /**
     * Update data pribadi dosen
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telp' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);

        $dosen->update([
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('dosen.profil.index')->with('success', 'Informasi pribadi berhasil diperbarui.');
    }

    /**
     * Update data umum termasuk foto profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
            $user->save();
        }

        $dosen->update([
            'no_telp' => $validated['no_telp'],
        ]);

        return redirect()->route('dosen.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Form edit data pribadi
     */
    public function edit()
    {
        $user = Auth::user();
        return view('dosen.profil.edit-profil', [
            'user' => $user,
            'activemenu' => 'profil',
        ]);
    }
}
