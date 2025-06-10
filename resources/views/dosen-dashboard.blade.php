@extends('layouts.dosen-app')

@section('content')
    <div class=" mt-24 text-center">
        <!-- Header -->
        <h1 class="text-2xl sm:text-3xl font-semibold mb-2">
            Selamat Datang,
            <span class="text-blue-600 font-bold hover:underline cursor-pointer">{{ auth()->user()->name }}</span> 👋
        </h1>
        <p class="text-gray-500 mb-6 text-sm sm:text-base">
            Lengkapi profil Anda sekarang untuk melihat Mahasiswa yang paling cocok untuk Anda Bimbing
        </p>

        <!-- Button Group -->
        <div class="flex justify-center gap-4 mb-18">
            <button class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5" onclick="location.href='{{ route('dosen.profil.index') }}'">
                Lengkapi Profile
            </button>
        </div>

        <!-- Data Log Aktivitas Mahasiswa -->
        <div class="flex justify-between items-center mt-10 mb-3">
            <h2 class="text-lg font-semibold">Data Log Aktivitas Mahasiswa</h2>
            <button class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5" onclick="location.href='{{ route('dosen.monitoring.index') }}'">
                Lihat Semua Log
            </button>
        </div>
    </div>

    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Mahasiswa</th>
                    <th class="px-6 py-3">Profesi Magang</th>
                    <th class="px-6 py-3">Perusahaan</th>
                    <th class="px-6 py-3">Semester</th>
                    <th class="px-6 py-3">Jenis Magang</th>
                    <th class="px-6 py-3">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuan as $log)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $pengajuan->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-[16px] text-gray-900">{{ $log->mahasiswa->user->name ?? '-' }}</div>
                            <div class="text-[14px] text-gray-500">{{ $log->mahasiswa->nim ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->lowongan->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->lowongan->perusahaan->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->mahasiswa->semester }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->lowongan->jenisMagang->jenis_magang }}
                        </td>
                        <td class="px-6 py-4">


                            <a href="{{ route('dosen.monitoring.show', $log->id) }}"
                                class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-blue-700 text-sm w-[120px] ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Lihat Log
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada log harian dari mahasiswa bimbingan Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- @if ($pengajuanList->hasPages())
                <div class="p-4">
                    {{ $pengajuanList->links('pagination::tailwind') }}
                </div>
            @endif --}}
    </div>
    </div>
@endsection
