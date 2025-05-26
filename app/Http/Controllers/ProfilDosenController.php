<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DosenPembimbing;
use App\Models\Skill;
use App\Models\User;
use App\Models\JenisMagang;

class ProfilDosenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing()->with(['prodi', 'jenismagang', 'skills'])->first();
        $allSkills = Skill::all();

        return view('dosen.profil.index', [
            'user' => $user,
            'dosen_pembimbing' => $dosen,
            'allSkills' => $allSkills,
            'activemenu' => 'profil',
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('dosen.profil.edit-profil', [
            'user' => $user,
            'dosen_pembimbing' => $user->dosenPembimbing,
            'activemenu' => 'profil',
        ]);
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;

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

    public function update(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                \Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
            $user->save();
        }

        $dosen->update([
            'no_telp' => $validated['no_telp'],
        ]);

        return redirect()->route('dosen.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }
    

    public function edit_preferensi()
    {
        $activemenu = 'profil';
        $user = Auth::user();
        $dosen = $user->dosenPembimbing()->with(['prodi', 'jenismagang', 'skills'])->first();
        $jenismagang = JenisMagang::all();
        $skills = Skill::all(); 

        return view('dosen.profil.edit_preferensi', [
            'activemenu' => $activemenu,
            'user' => $user,
            'dosen' => $dosen,
            'skills' => $skills,
            'jenismagang' => $jenismagang
        ]);
    }


    public function updatePreferensi(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;

        $request->validate([
            'preferensi_lokasi' => 'required|string|max:100',
            'jenis_magang_id' => 'required|exists:jenis_magang,id',
            'skills' => 'nullable|array',
        ]);

        $dosen->update([
            'preferensi_lokasi' => $request->preferensi_lokasi,
            'jenis_magang_id' => $request->jenis_magang_id,
        ]);

        if ($request->has('skills')) {
            $dosen->skills()->sync($request->skills);
        }

        return redirect()->route('dosen.profil.index')->with('success', 'Preferensi magang berhasil diperbarui.');
    }
}
