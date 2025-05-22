@extends('layouts.mahasiswa-app')

@section('content')

    {{-- Form Edit Preferensi Magang --}}
    <form method="POST" action="{{route('mahasiswa.profil.update_preferensi',$user->id) }}" class="bg-white border border-gray-200 rounded-lg p-6">
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
                    @foreach ($skills as $skill)
        <div class="flex items-center">
            <input id="skill-{{ $skill->id }}" name="skills[]" value="{{ $skill->id }}"
                type="checkbox"
                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                {{ in_array($skill->id, $mahasiswa->skills->pluck('id')->toArray()) ? 'checked' : '' }}>
            <label for="skill-{{ $skill->id }}" class="ml-2 block text-sm text-gray-900">
                {{ $skill->nama }}
            </label>
        </div>
    @endforeach
            </div>

            {{-- Jenis Magang --}}
            <div>
                <label class="block text-sm font-medium text-gray-900">Jenis Magang</label>
                <select name="jenis_magang" class="mt-2 w-full rounded-md border-gray-300 text-sm shadow-sm">
                    @foreach ($jenismagang as $jenis)
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
