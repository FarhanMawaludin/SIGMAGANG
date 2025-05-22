
@extends('layouts.mahasiswa-app')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-800">Log Harian Minggu ke-{{ $logMingguan->minggu }}</h1>
    <a href="{{ route('mahasiswa.monitoring.index') }}"
        class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">
        &larr; Kembali ke Log Mingguan
    </a>
</div>

<div class="overflow-x-auto relative rounded-lg border border-gray-200 bg-white">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Aktivitas</th>
                <th class="px-6 py-3">Aksi</th> 
            </tr>
        </thead>
        <tbody>
            @forelse ($logMingguan->logHarian as $index => $log)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('l, d F Y')}}</td>
                    <td class="px-6 py-4">{{ $log->aktivitas }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('mahasiswa.monitoring.edit_harian', [$logMingguan->id, $log->id]) }}"
                            class="inline-flex items-center bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700 transition">
                            Edit
                        </a>
                        <a href="{{ route('mahasiswa.monitoring.detail_harian', [$logMingguan->id, $log->id]) }}"
                             class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                            Detail
                        </a>
                    </td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Belum ada log harian untuk minggu ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- Button to add log harian, only show if less than 7 logs --}}
    @if ($logMingguan->logHarian->count() < 7)
        <div class="p-4 border-t border-gray-200 flex justify-end">
            <a href="{{ route('mahasiswa.monitoring.create_harian', $logMingguan->id) }}"
                class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                + Tambah Log Harian
            </a>
        </div>
    @endif
</div>
@endsection