@extends('layouts.dosen-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas Mahasiswa Bimbingan</h1>
    </div>

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

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
                @forelse ($pengajuanList as $log)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $pengajuanList->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4">
                            {{ $log->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}
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
                                class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                                Detail
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

        @if ($pengajuanList->hasPages())
            <div class="p-4">
                {{ $pengajuanList->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
@endsection