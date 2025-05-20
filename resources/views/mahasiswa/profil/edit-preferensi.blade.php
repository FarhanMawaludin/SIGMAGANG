@extends('layouts.mahasiswa-app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Edit Preferensi Magang</h2>

    <form action="{{ route('mahasiswa.preferensi.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">IPK</label>
                <input type="text" name="ipk" value="{{ old('ipk', $user->mahasiswa->ipk) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Preferensi Lokasi</label>
                <input type="text" name="preferensi_lokasi" value="{{ old('preferensi_lokasi', $user->mahasiswa->preferensi_lokasi) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="col-span-2">
                <label class="block mb-1 text-sm font-medium text-gray-700">Kemampuan (Skill)</label>
                <input type="text" name="skills" value="{{ old('skills', $user->mahasiswa->skills->pluck('nama')->implode(', ')) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                <small class="text-gray-500">Pisahkan dengan koma, contoh: Laravel, JavaScript, UI/UX</small>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Jenis Magang</label>
                <select name="jenis_magang_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                    @foreach ($jenisMagangList as $jenis)
                        <option value="{{ $jenis->id }}" {{ $user->mahasiswa->jenis_magang_id == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->jenis_magang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Semester</label>
                <input type="text" name="semester" value="{{ old('semester', $user->mahasiswa->semester) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg">Simpan Preferensi</button>
        </div>
    </form>
</div>
@endsection
