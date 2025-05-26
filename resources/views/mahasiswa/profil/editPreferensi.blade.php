@extends('layouts.mahasiswa-app')

@section('content')
    {{-- Form Edit Preferensi Magang --}}
    <form method="POST" action="{{ route('mahasiswa.profil.update_preferensi', $user->id) }}">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Edit Preferensi Magang</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mb-4 ">
                {{-- IPK --}}
                <div class="sm:col-span-3">
                    <label for="ipk" class="block text-sm/6 font-medium text-gray-900">IPK</label>
                    <div class="mt-2">
                        <input type="text" name="ipk" id="ipk"
                            value="{{ old('ipk', $user->mahasiswa->ipk ?? 'IPK Tidak Ditemukan') }}"
                            autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('ipk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <label class="block text-sm font-medium text-gray-900">IPK</label>
                    <input type="text" name="ipk" value="{{ old('ipk', $user->mahasiswa->ipk) }}"
                        class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600"> --}}
                </div>

                {{-- Lokasi --}}
                <div class="sm:col-span-3">
                    <label for="preferensi_lokasi" class="block text-sm/6 font-medium text-gray-900">Preferensi
                        Lokasi</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="preferensi_lokasi" name="preferensi_lokasi" autocomplete="role-name"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="malang">Malang</option>
                            <option value="luar malang">Luar Malang</option>
                        </select>
                    </div>
                </div>
                @error('preferensi_lokasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                {{-- <label class="block text-sm font-medium text-gray-900">Preferensi Lokasi</label>
                    <input type="text" name="preferensi_lokasi"
                        value="{{ old('preferensi_lokasi', $user->mahasiswa->preferensi_lokasi) }}"
                        class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600"> --}}
            </div>

            {{-- Skill --}}
            <div class="col-span-full mb-4">
                <label class="block text-sm/6 font-medium text-gray-900 mb-2">Kemampuan (Skill)</label>
                <div
                    class="grid grid-cols-6 gap-4 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-4 pr-4 pl-4 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

                    @php
                        $mahasiswaSkills = optional($mahasiswa)->skills?->pluck('id')->toArray() ?? [];
                    @endphp

                    @foreach ($skills as $skill)
                        <div class="flex items-center">
                            <input id="skill-{{ $skill->id }}" name="skills[]" value="{{ $skill->id }}"
                                type="checkbox"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                {{ in_array($skill->id, $mahasiswaSkills) ? 'checked' : '' }}>
                            <label for="skill-{{ $skill->id }}" class="ml-2 text-sm text-gray-900 truncate">
                                {{ $skill->nama }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-6 gap-x-6 gap-y-8">
                {{-- Jenis Magang --}}
                <div class="sm:col-span-3 ">
                    <label class="block text-sm font-medium text-gray-900">Jenis Magang</label>
                    <select id="jenis_magang_id" name="jenis_magang_id"
                        class="mt-2 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @foreach ($jenismagang as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ old('jenis_magang_id', optional($user->mahasiswa)->jenis_magang_id) == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->jenis_magang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tipe Magang --}}
                <div class="sm:col-span-3">
                    <label for="tipe_magang" class="block text-sm/6 font-medium text-gray-900">Tipe Magang</label>
                    <div class=" grid grid-cols-1">
                        <select id="tipe_magang" name="tipe_magang" autocomplete="role-name"
                            class="mt-1 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="onsite">onsite</option>
                            <option value="remote">remote</option>
                        </select>
                    </div>
                    {{-- <label class="block text-sm font-medium text-gray-900">Semester</label>
                    <input type="text" name="semester" value="{{ old('semester', $user->mahasiswa->semester) }}"
                        class="mt-2 w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-indigo-600"> --}}
                </div>
            </div>
            {{-- Tombol --}}
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <a href="{{ route('mahasiswa.profil.index') }}"
                    class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan
                    Perubahan</button>
            </div>
        </div>
    </form>
@endsection
