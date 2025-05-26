@extends('layouts.mahasiswa-app')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Profile Saya</h2>

    <!-- Header Profil dengan Foto -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6 flex items-center gap-6">
        @if ($user->mahasiswa && $user->mahasiswa->user->foto)
            <img src="{{ asset('storage/' . $user->mahasiswa->user->foto) }}" alt="Foto Profil"
                class="w-24 h-24 rounded-full object-cover border border-gray-300">
        @else
            <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                class="w-24 h-24 rounded-full object-cover border border-gray-300">
        @endif

        {{-- <img src="{{ asset('storage/' . $user->mahasiswa->user->foto) }}" alt="Foto Profil"
            class="w-24 h-24 rounded-full object-cover border border-gray-300"> --}}
        <div>
            <h3 class="text-[22px] font-semibold text-gray-900">{{ $user->name }}</h3>
            <p class="text-[18px] text-gray-700">{{ $user->mahasiswa->nim ?? 'NIM Tidak Ditemukan' }}</p>
            <p class="text-[18px] text-gray-400">{{ $user->mahasiswa->prodi->nama ?? 'Program Studi Tidak Ditemukan' }}</p>
        </div>
    </div>

    <!-- Informasi Pribadi -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <span class="text-lg font-semibold text-gray-800">Informasi Pribadi</span>
            <a href="{{ route('mahasiswa.profil.edit', $user->id) }}"
                class="inline-flex items-center gap-2 border border-yellow-400 text-yellow-500 hover:bg-yellow-500 hover:text-white font-semibold px-5 py-2 rounded-full transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class=" text-[16px] text-gray-500 mb-1">Nama Lengkap</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">NIM</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->nim ?? 'NIM Tidak Ditemukan' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Email</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">No Telepon</p>
                <p class=" text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->no_telp ?? 'No Telepon Tidak Ditemukan' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Prodi</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->prodi->nama ?? 'Program Studi Tidak Ditemukan' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Semester</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->semester ?? 'Semester Tidak Ditemukan' }}</p>
            </div>
        </div>
    </div>

    <!-- Preferensi Magang -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <span class="text-lg font-semibold text-gray-800">Preferensi Magang</span>
            <a href="{{ route('mahasiswa.profil.editPreferensi', $user->id) }}"
                class="inline-flex items-center gap-2 border border-yellow-400 text-yellow-500 hover:bg-yellow-500 hover:text-white font-semibold px-5 py-2 rounded-full transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class="text-[16px] text-gray-500 mb-1">IPK</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->ipk ?? 'IPK Tidak Ditemukan' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Preferensi Lokasi</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->preferensi_lokasi ?? 'Preferensi Lokasi Tidak Ditemukan' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Kemampuan</p>
                <p class="text-[18px] font-semibold text-gray-900">
                    @forelse ($mahasiswa?->skills ?? [] as $skill)
                        {{ !$loop->first ? ', ' : '' }}{{ $skill->nama  }}
                    @empty
                        -
                    @endforelse
                </p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500">Jenis Magang</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->jenismagang->jenis_magang ?? 'Jenis Magang Tidak Ditemukan' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500">Tipe Magang</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->mahasiswa->tipe_magang ?? 'Tipe Magang Tidak Ditemukan' }}</p>
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
                    <p class="text-[16px] text-gray-500 mb-1">{{ $file['label'] }}</p>
                    <a href="{{ asset('storage/' . $file['path'] . '/' . $file['file']) }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-gray-100 border border-gray-300 rounded-lg pl-3 pr-36 py-2.5 text-gray-600 text-sm hover:bg-gray-200">
                        <svg class="w-8 h-8 text-red-600 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                        </svg>
                        <span class="text-gray-700 text-[16px]">file.pdf</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
