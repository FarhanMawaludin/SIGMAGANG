<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class PenggunaController extends Controller
{
    use PasswordValidationRules;
    
    public function index(Request $request)
    {
        $activemenu = 'pengguna';

        $search = $request->input('search');
        $category = $request->input('category', 'all');

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($category !== 'all') {
            $query->where('role', $category);
        }

        $user = $query->paginate(10)->appends([
            'search' => $search,
            'category' => $category
        ]);

        return view('admin.pengguna.index', [
            'activemenu' => $activemenu,
            'user' => $user,
            'category' => $category,
            'search' => $search,
        ]);
    }

    public function create()
    {
        $activemenu = 'pengguna';
        return view('admin.pengguna.create', ['activemenu' => $activemenu]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $activemenu = 'pengguna';
        return view('admin.pengguna.edit', [
            'activemenu' => $activemenu,
            'user' => $user
        ]);
    }
    public function store(Request $request)
    {
        // Validasi form (otomatis kembali ke form dengan @error jika gagal)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'mahasiswa', 'dosen_pembimbing'])],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah digunakan sebelumnya.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Posisi wajib dipilih.',
            'role.in' => 'Posisi yang dipilih tidak valid.',
        ]);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            return redirect()->route('admin.pengguna.index')
                ->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan pengguna.');
        }
    }
    public function show($id)
    {
        $activemenu = 'pengguna';
        $user = User::findOrFail($id);
        return view('admin.pengguna.show', [
            'activemenu' => $activemenu,
            'user' => $user,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'mahasiswa', 'dosen_pembimbing'])],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email salah.',
            'email.unique' => 'Email sudah digunakan sebelumnya.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Posisi wajib dipilih.',
            'role.in' => 'Posisi yang dipilih tidak valid.',
        ]);

        try {
            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ];

            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            $user = User::findOrFail($id);
            $user->update($updateData);

            return redirect()->route('admin.pengguna.index')
                ->with('success', 'Pengguna berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'error' => 'Terjadi kesalahan saat mengupdate pengguna: ' . $e->getMessage()
                ]);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
