
@extends('layouts.dosen-app')
@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-800">Log Harian Minggu ke-{{ $logMingguan->minggu }}</h1>
   <a href="{{ route('dosen.monitoring.create_feedback', $logMingguan->id) }}"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Tambah feedback
</a>
</div>

<div class="overflow-x-auto relative rounded-lg border border-gray-200 bg-white">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Aktivitas</th>
                <th class="px-6 py-3">Jam Masuk</th>
                <th class="px-6 py-3">Jam Pulang</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logMingguan->logHarian as $index => $log)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('l, d F Y')}}</td>
                    <td class="px-6 py-4">{{ $log->aktivitas }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->jam_mulai)->translatedFormat('H:i') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->jam_selesai)->translatedFormat('H:i') }}</td>    
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
</div>
@endsection