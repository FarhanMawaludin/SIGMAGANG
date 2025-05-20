@extends('layouts.mahasiswa-app')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-800">Detail Log Harian</h1>
    <a href="{{ route('mahasiswa.monitoring.show', $logHarian->log_mingguan_id) }}"
        class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">
        &larr; Kembali ke Log Mingguan
    </a>
</div>

<div class="overflow-x-auto relative rounded-lg border border-gray-200 bg-white w-full">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-6 py-3 w-1/3">INFORMASI</th>
                <th class="px-6 py-3">DETAIL</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium">Tanggal</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($logHarian->tanggal)->format('d M Y') }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium">Jam Mulai</td>
                <td class="px-6 py-4">{{ $logHarian->jam_mulai }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium">Jam Selesai</td>
                <td class="px-6 py-4">{{ $logHarian->jam_selesai }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium">Aktivitas</td>
                <td class="px-6 py-4">{{ $logHarian->aktivitas }}</td>
            </tr>
            <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4 font-medium">Keterangan</td>
                <td class="px-6 py-4">{{ $logHarian->keterangan ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection