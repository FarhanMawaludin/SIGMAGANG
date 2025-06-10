@extends('layouts.dosen-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas Mingguan Mahasiswa Bimbingan</h1>
    </div>

    {{-- Tampilkan pesan error jika ada --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tampilkan daftar mahasiswa bimbingan
    @if ($mahasiswaBimbingan->isNotEmpty())
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Daftar Mahasiswa Bimbingan</h2>
            <ul class="list-disc list-inside text-gray-600">
                @foreach ($mahasiswaBimbingan as $mhs)
                    <li>{{ $mhs->user->name ?? 'Nama Tidak Ditemukan' }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    {{-- Tabel log harian --}}
    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Mahasiswa</th>
                    <th class="px-6 py-3">Minggu</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Feedback</th>
                    <th class="px-6 py-3">Detail Harian</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logMingguan as $log)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $logMingguan->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4">
                            {{ $log->pengajuan->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->minggu }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($log->tanggal_awal)->translatedFormat('l, d F Y') }} -
                            {{ \Carbon\Carbon::parse($log->tanggal_akhir)->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="px-6 py-4">{{ $log->dosen_feedback ?? 'Belum ada feedback' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('dosen.monitoring.show_harian', $log->id) }}"
                                class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-blue-700 text-sm w-[100px] ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Detail
                            </a>
                        </td>
                        {{-- <td class="px-6 py-4">
                            @if ($log->feedback)
                                <span class="text-green-600">Sudah diberi</span>
                            @else
                                <span class="text-gray-500 italic">Belum ada</span>
                            @endif
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada log harian dari mahasiswa bimbingan Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- @if ($logs->hasPages())
            <div class="p-4">
                {{ $logs->links('pagination::tailwind') }}
            </div>
        @endif --}}
    </div>
@endsection
