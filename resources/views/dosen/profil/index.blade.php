@extends('layouts.dosen-app')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Profil Saya</h2>
    <!-- Header Profil dengan Foto -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6 flex items-center gap-6">
        @if (Auth::user()->foto)
            <img class="w-24 h-24 rounded-full" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="user photo">
        @else
            <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                class="w-24 h-24 rounded-full object-cover border border-gray-300">
        @endif
        <div>
            <h3 class="text-[22px] font-semibold text-gray-900">{{ $user->name }}</h3>
            <p class="text-[18px] text-gray-700">{{ $dosen_pembimbing->nidn ?? '-' }}</p>
            <p class="text-[18px] text-gray-400">{{ $dosen_pembimbing->prodi->nama ?? '-' }}</p>
        </div>
    </div>

    <!-- Informasi Pribadi -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <span class="text-lg font-semibold text-gray-800">Informasi Pribadi</span>
            <a href="{{ route('dosen.profil.edit', $user->id) }}"
                class="inline-flex items-center gap-2 border border-yellow-400 text-yellow-500 hover:bg-yellow-50 font-semibold px-5 py-2 rounded-full transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm-6 6h12" />
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Nama Lengkap</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">NIDN</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $dosen_pembimbing->nidn ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Email</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">No Telepon</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $dosen_pembimbing->no_telp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Prodi</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $dosen_pembimbing->prodi->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Jabatan Akademik</p>
                <p class="text-[18px] font-semibold text-gray-900">
                    {{ isset($dosen_pembimbing->jabatan) ? str_replace('_', ' ', $dosen_pembimbing->jabatan) : '-' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Preferensi Magang -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <span class="text-lg font-semibold text-gray-800">Preferensi Magang</span>
            <a href="{{ route('dosen.profil.edit_preferensi', $user->id) }}"
                class="inline-flex items-center gap-2 border border-yellow-400 text-yellow-500 hover:bg-yellow-50 font-semibold px-5 py-2 rounded-full transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm-6 6h12" />
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Preferensi Lokasi</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $dosen_pembimbing->preferensi_lokasi ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Jenis Magang</p>
                <p class="text-[18px] font-semibold text-gray-900">
                    {{ $dosen_pembimbing->jenisMagang->jenis_magang ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Kemampuan</p>
                <p class="text-[18px] font-semibold text-gray-900">
                    @forelse ($dosen_pembimbing->skills ?? [] as $skill)
                        {{ !$loop->first ? ', ' : '' }}{{ $skill->nama }}
                    @empty
                        -
                    @endforelse
                </p>
            </div>
        </div>
        <!-- Dokumen Magang -->
    </div>
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <span class="text-lg font-semibold text-gray-800">Dokumen Magang</span>
            <a href="{{ route('dosen.profil.unggahDokumen', $user->id) }}"
                class="inline-flex items-center gap-2 border border-yellow-400 text-yellow-500 hover:bg-yellow-500 hover:text-white font-semibold px-5 py-2 rounded-full transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit
            </a>
        </div>

        <!-- Files -->
        <div class="grid grid-cols-2 gap-6 mt-6">
            {{-- CV --}}
            <div>
                <p class="text-[16px] text-gray-500 mb-1">File CV</p>
                @if ($dokumen_cv)
                    <a href="{{ asset('storage/' . $dokumen_cv->file_path) }}" target="_blank"
                        class="flex items-center justify-between w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 min-h-[52px] hover:bg-gray-200">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                            </svg>
                            <span class="text-[16px] text-gray-900">Lihat CV</span>
                        </div>
                    </a>
                @else
                    <span class="text-[16px] text-gray-900">Belum ada file</span>
                @endif
            </div>


            {{-- Surat Pengantar --}}
            <div>
                <p class="text-[16px] text-gray-500 mb-1">File Surat Pengantar</p>
                @if ($dokumen_pengantar)
                    <a href="{{ asset('storage/' . $dokumen_pengantar->file_path) }}" target="_blank"
                        class="flex items-center justify-between w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 min-h-[52px] hover:bg-gray-200">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                            </svg>
                            <span class="text-[16px] text-gray-900">Lihat Surat Pengantar</span>
                        </div>
                    </a>
                @else
                    <span class="text-[16px] text-gray-900">Belum ada file</span>
                @endif
            </div>

            {{-- Sertifikat --}}
            <div>
                <p class="text-[16px] text-gray-500 mb-1">File Sertifikat</p>
                @if ($dokumen_sertifikat && $dokumen_sertifikat->count())
                    <ul class="space-y-2">
                        @foreach ($dokumen_sertifikat as $sertifikat)
                            <li>
                                <a href="{{ asset('storage/' . $sertifikat->file_path) }}" target="_blank"
                                    class="flex items-center justify-between w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 min-h-[52px] hover:bg-gray-200">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                                        </svg>
                                        <span class="text-[16px] text-gray-900">Lihat Sertifikat</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <span class="text-[16px] text-gray-900">Belum ada file</span>
                @endif
            </div>
        </div>
    </div>
@endsection
