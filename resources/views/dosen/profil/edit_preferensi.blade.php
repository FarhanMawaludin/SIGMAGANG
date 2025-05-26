@extends('layouts.dosen-app')

@section('content')
    {{-- Form Edit Preferensi Magang --}}
    <form method="POST" action="{{ route('dosen.profil.update_preferensi', $user->id) }}">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Edit Preferensi Magang</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mb-4">
                {{-- Preferensi Lokasi --}}
                <div class="sm:col-span-3">
                    <label for="preferensi_lokasi" class="block text-sm/6 font-medium text-gray-900">Preferensi Lokasi</label>
                    <div class="mt-2">
                        <input type="text" id="preferensi_lokasi" name="preferensi_lokasi"
                            value="{{ old('preferensi_lokasi', $user->dosenPembimbing->preferensi_lokasi ?? '') }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('preferensi_lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Jenis Magang --}}
                <div class="sm:col-span-3">
                    <label for="jenis_magang_id" class="block text-sm/6 font-medium text-gray-900">Jenis Magang</label>
                    <select id="jenis_magang_id" name="jenis_magang_id"
                        class="mt-2 w-full rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @foreach ($jenismagang as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ old('jenis_magang_id', $user->dosenPembimbing->jenis_magang_id) == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->jenis_magang }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Skill --}}
            <div class="col-span-full mb-4">
                <label class="block text-sm/6 font-medium text-gray-900 mb-2">Kemampuan (Skill)</label>
                <div
                    class="grid grid-cols-6 gap-4 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-4 pr-4 pl-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

                    @php
                        $dosenSkills = optional($dosen)->skills?->pluck('id')->toArray() ?? [];
                    @endphp

                    @foreach ($skills as $skill)
                        <div class="flex items-center">
                            <input id="skill-{{ $skill->id }}" name="skills[]" value="{{ $skill->id }}"
                                type="checkbox"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                {{ in_array($skill->id, $dosenSkills) ? 'checked' : '' }}>
                            <label for="skill-{{ $skill->id }}" class="ml-2 text-sm text-gray-900 truncate">
                                {{ $skill->nama }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <a href="{{ route('dosen.profil.index') }}"
                    class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan
                    Perubahan</button>
            </div>
        </div>
    </form>
@endsection
