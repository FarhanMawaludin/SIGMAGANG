@extends('layouts.mahasiswa-app')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Profile Saya</h2>

    <!-- Header Profil dengan Foto -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6 flex items-center gap-6">
        <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Foto Profil"
            class="w-24 h-24 rounded-full object-cover">
        {{-- "{{ asset('storage/foto_profil/' . $user->foto_profil) }}" --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
            <p class="text-gray-500">{{ $user->mahasiswa->nim }}</p>
            <p class="text-gray-400">{{ $user->mahasiswa->prodi->nama }}</p>
        </div>
    </div>

    <!-- Informasi Pribadi -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
            <a href="#"
                class="inline-flex items-center gap-1 text-yellow-500 font-semibold border border-yellow-400 px-4 py-1 rounded hover:bg-yellow-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class="text-gray-500">Nama Lengkap</p>
                <p class="font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-gray-500">NIM</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->nim }}</p>
            </div>
            <div>
                <p class="text-gray-500">Email</p>
                <p class="font-semibold text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-gray-500">No Telepon</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->no_telp }}</p>
            </div>
            <div>
                <p class="text-gray-500">Prodi</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->prodi->nama }}</p>
            </div>
            <div>
                <p class="text-gray-500">Semester</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->semester }}</p>
            </div>
        </div>
    </div>

    <!-- Preferensi Magang -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-semibold text-gray-900">Preferensi Magang</h3>
            <a href="#"
                class="inline-flex items-center gap-1 text-yellow-500 font-semibold border border-yellow-400 px-4 py-1 rounded hover:bg-yellow-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class="text-gray-500">IPK</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->ipk }}</p>
            </div>
            <div>
                <p class="text-gray-500">Preferensi Lokasi</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->preferensi_lokasi }}</p>
            </div>
            <div>
                <p class="text-gray-500">Kemampuan</p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($user->mahasiswa->skills as $skill)
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $skill->nama }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <p class="text-gray-500">Jenis Magang</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->jenisMagang->jenis_magang }}</p>
            </div>
            <div>
                <p class="text-gray-500">Prodi</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->prodi->nama }}</p>
            </div>
            <div>
                <p class="text-gray-500">Semester</p>
                <p class="font-semibold text-gray-900">{{ $user->mahasiswa->semester }}</p>
            </div>
        </div>

        <!-- Files -->
        <div class="grid grid-cols-2 gap-6 mt-6">
            @php
                $files = [
                    ['label' => 'File CV', 'path' => 'cv', 'file' => $user->cv],
                    ['label' => 'File Transkrip Nilai', 'path' => 'transkrip', 'file' => $user->transkrip_nilai],
                    ['label' => 'File Sertifikat', 'path' => 'sertifikat', 'file' => $user->sertifikat],
                    ['label' => 'File Surat Pengantar', 'path' => 'pengantar', 'file' => $user->surat_pengantar],
                ];
            @endphp

            @foreach ($files as $file)
                <div>
                    <p class="text-gray-500 mb-1">{{ $file['label'] }}</p>
                    <a href="{{ asset('storage/' . $file['path'] . '/' . $file['file']) }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-gray-100 border border-gray-300 rounded px-3 py-1 text-gray-600 text-sm hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linejoin="round"
                            stroke-linecap="round">
                            <path d="M6 2h7a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z" />
                            <path d="M14 2v6h6" />
                        </svg>
                        <span>file.pdf</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
