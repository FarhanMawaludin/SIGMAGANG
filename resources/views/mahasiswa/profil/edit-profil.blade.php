@extends('layouts.mahasiswa-app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Edit Profil Pribadi</h2>

    <form action="{{ route('mahasiswa.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">NIM</label>
                <input type="text" value="{{ $user->mahasiswa->nim }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100" readonly>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">No Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp', $user->mahasiswa->no_telp) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Prodi</label>
                <input type="text" value="{{ $user->mahasiswa->prodi->nama }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100" readonly>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Semester</label>
                <input type="text" name="semester" value="{{ old('semester', $user->mahasiswa->semester) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
