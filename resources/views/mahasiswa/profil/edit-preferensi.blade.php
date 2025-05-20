@extends('layouts.mahasiswa-app')

@section('content')

    {{-- Form Edit Profil Mahasiswa --}}
    <form method="POST" action="{{ route('profil.update-profil') }}" enctype="multipart/form-data"
        class="bg-white border border-gray-200 rounded-lg p-6">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Edit Profil Mahasiswa</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Nama Lengkap --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>

            {{-- NIM --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">NIM</label>
                <input type="text" value="{{ $user->mahasiswa->nim }}" readonly
                    class="mt-2 w-full bg-gray-100 px-3 py-2 rounded-md border border-gray-300 text-sm text-gray-700">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>

            {{-- No Telepon --}}
            <div>
                <label for="no_telp" class="block text-sm font-medium text-gray-900">No Telepon</label>
                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp', $user->mahasiswa->no_telp) }}"
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>

            {{-- Program Studi --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">Program Studi</label>
                <input type="text" value="{{ $user->mahasiswa->prodi->nama }}" readonly
                    class="mt-2 w-full bg-gray-100 px-3 py-2 rounded-md border border-gray-300 text-sm text-gray-700">
            </div>

            {{-- Semester --}}
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-900">Semester</label>
                <input type="text" name="semester" id="semester" value="{{ old('semester', $user->mahasiswa->semester) }}"
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>

            {{-- Foto --}}
            <div class="col-span-full">
                <label for="foto" class="block text-sm font-medium text-gray-900">Foto Profil</label>
                <input type="file" id="foto" name="foto" accept="image/*"
                    class="mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <p class="mt-1 text-sm text-gray-500">JPG, PNG, atau GIF. Max 800x400px.</p>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-4">
            <a href="{{ route('dashboard.mahasiswa') }}"
                class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-4 py-2">Batal</a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-md shadow-sm">Simpan Perubahan</button>
        </div>
    </form>

    {{-- Form Edit Preferensi Magang --}}
    <form method="POST" action="{{ route('preferensi.update') }}" class="bg-white border border-gray-200 rounded-lg p-6">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Edit Preferensi Magang</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- IPK --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">IPK</label>
                <input type="text" name="ipk" value="{{ old('ipk', $user->mahasiswa->ipk) }}"
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>

            {{-- Lokasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">Preferensi Lokasi</label>
                <input type="text" name="preferensi_lokasi" value="{{ old('preferensi_lokasi', $user->mahasiswa->preferensi_lokasi) }}"
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>

            {{-- Skill --}}
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-900">Kemampuan (Skill)</label>
                <input type="text" name="skills" value="{{ old('skills', $user->mahasiswa->skills->pluck('nama')->implode(', ')) }}"
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
                <small class="text-gray-500">Pisahkan dengan koma, contoh: Laravel, JavaScript, UI/UX</small>
            </div>

            {{-- Jenis Magang --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">Jenis Magang</label>
                <select name="jenis_magang" class="mt-2 w-full rounded-md border-gray-300 text-sm shadow-sm">
                    @foreach ($jenisMagangList as $jenis)
                        <option value="{{ $jenis->jenis_magang }}" {{ $user->mahasiswa->jenis_magang == $jenis->jenis_magang ? 'selected' : '' }}>
                            {{ $jenis->jenis_magang }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Semester (readonly) --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">Semester</label>
                <input type="text" name="semester" value="{{ old('semester', $user->mahasiswa->semester) }}"
                    class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-sm">Simpan Preferensi</button>
        </div>
    </form>

</div>
@endsection
