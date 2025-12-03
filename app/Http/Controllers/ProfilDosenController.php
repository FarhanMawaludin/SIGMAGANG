<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\DosenPembimbing;
use App\Models\Skill;
use App\Models\JenisMagang;
use App\Models\Prodi;

class ProfilDosenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosenPembimbing;
        if (!$dosen) {
            return view('dosen.profil.index', [
                'user' => $user,
                'dosen_pembimbing' => null,
                'allSkills' => [],
                'activemenu' => 'profil',
                'dokumen_cv' => null,
                'dokumen_pengantar' => null,
                'dokumen_sertifikat' => collect(),
            ])->with('warning', 'Profil dosen belum dilengkapi.');
        }

        // Ambil dokumen-dokumen dosen
        $dokumen_cv = $dosen->documents()->where('tipe', 'CV')->whereNotNull('file_path')->first();
        $dokumen_pengantar = $dosen->documents()->where('tipe', 'Surat Pengantar')->whereNotNull('file_path')->first();
        $dokumen_sertifikat = $dosen->documents()->where('tipe', 'Sertifikat')->whereNotNull('file_path')->get();

        $dosen = $user->dosenPembimbing()->with(['prodi', 'jenismagang', 'skills'])->first();
        $allSkills = Skill::all();

        return view('dosen.profil.index', [
            'user' => $user,
            'dosen_pembimbing' => $dosen,
            'allSkills' => $allSkills,
            'activemenu' => 'profil',
            'dokumen_cv' => $dokumen_cv,
            'dokumen_pengantar' => $dokumen_pengantar,
            'dokumen_sertifikat' => $dokumen_sertifikat,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        $prodis = Prodi::all();
        return view('dosen.profil.edit-profil', [
            'user' => $user,
            'prodis' => $prodis,
            'dosen_pembimbing' => $user->dosen,
            'activemenu' => 'profil',
        ]);
    }

    // public function updateProfil(Request $request)
    // {
    //     $user = Auth::user();
    //     $dosen = $user->dosenPembimbing;

    //     $request->validate([
    //         'nama_lengkap' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'no_telp' => 'nullable|string|max:20',
    //         'nidn' => 'required|string|max:255',
    //     ]);

    //     // Update ke tabel users
    //     $user->update([
    //         'name' => $request->nama_lengkap,
    //         'email' => $request->email,
    //     ]);

    //     // Update ke tabel dosen_pembimbing
    //     $dosen->update([
    //         'no_telp' => $request->no_telp,
    //         'nidn' => $request->nidn,
    //     ]);

    //     return redirect()->route('dosen.profil.index')->with('success', 'Informasi pribadi berhasil diperbarui.');
    // }


    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => ['required', 'string', 'max:20', 'regex:/^\d+$/'],
            'nidn' => 'required|digits:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prodi_id' => 'required',
            'jabatan' => ['required', Rule::in(['lektor', 'asisten_ahli'])],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah digunakan sebelumnya.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.max' => 'Nomor telepon maksimal 20 digit.',
            'no_telp.regex' => 'Nomor telepon harus berupa angka saja.',
            'semester.required' => 'Semester wajib diisi.',
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.digits' => 'NIDN harus terdiri dari tepat 10 angka.',
            'prodi_id.required' => 'Prodi wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.in' => 'Jabatan harus antara lektor atau asisten ahli.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        $dosen = $user->dosenPembimbing;

        if (!$dosen) {
            $dosen = new \App\Models\DosenPembimbing();
            $dosen->user_id = $user->id;
        }

        $dosen->no_telp = $validated['no_telp'];
        $dosen->nidn = $validated['nidn'];
        $dosen->jabatan = $validated['jabatan'];
        $dosen->prodi_id = $validated['prodi_id'];
        $dosen->save();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
            $user->save();
        }

        return redirect()->route('dosen.profil.index')->with('success', 'Profil berhasil diperbarui');
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

        $data = [
            'preferensi_lokasi' => $request->preferensi_lokasi,
            'jenis_magang_id' => $request->jenis_magang_id,

        ];
        if ($request->has('skills')) {
            $dosen->skills()->sync($request->skills);
        }

        // Proses upload file
        foreach (['file_cv', 'file_transkrip', 'file_sertifikat', 'file_surat_pengantar'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField)->store('dokumen_magang', 'public');
                $data[$fileField] = $file;
            }
        }
        $dosen->update($data);

        return redirect()->route('dosen.profil.index')->with('success', 'Preferensi magang berhasil diperbarui.');
    }
    public function unggahDokumen()
    {
        $activemenu = 'profil';
        $user = Auth::user();
        $dosen_pembimbing = $user->dosenPembimbing()->with(['prodi', 'jenismagang', 'skills'])->first();
        return view('dosen.profil.unggahDokumen', [
            'activemenu' => $activemenu,
            'user' => $user,
            'dosen_pembimbing' => $dosen_pembimbing,
        ]);
    }
}
