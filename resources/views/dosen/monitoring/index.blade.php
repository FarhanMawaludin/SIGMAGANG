@extends('layouts.dosen-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas Mahasiswa Bimbingan</h1>
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
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Kegiatan</th>
                    <th class="px-6 py-3">Feedback</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $logs->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4">
                            {{ $log->logMingguan->pengajuan->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->aktivitas }}
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
