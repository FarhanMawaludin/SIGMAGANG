@extends('layouts.mahasiswa-app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Harian Minggu ke-{{ $logMingguan->minggu }}</h1>
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
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td class="px-6 py-4">{{ $log->aktivitas }}</td>
                        <td class="px-6 py-4">
                            <!-- Edit -->
                            <a href="{{ route('mahasiswa.monitoring.edit_harian', [$logMingguan->id, $log->id]) }}"
                                class="inline-flex items-center bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                <span class="hidden md:inline">Edit</span>
                            </a>
                            <!-- Detail -->
                            <button
                                class="inline-flex items-center bg-blue-600 text-white  px-4 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer"
                                onclick="location.href='{{ route('mahasiswa.monitoring.detail_harian', [$logMingguan->id, $log->id]) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <span class="hidden md:inline">Detail</span>
                            </button>
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
            <div class="p-4 border-t border-gray-200 flex justify-between">
                <a href="{{ route('mahasiswa.monitoring.index') }}"
                    class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">
                    &larr; Kembali ke Log Mingguan
                </a>
                <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button"
                    onclick="location.href='{{ route('mahasiswa.monitoring.create_harian', $logMingguan->id) }}'">Tambah Log
                    Harian
                </button>
                {{-- <a href="{{ route('mahasiswa.monitoring.create_harian', $logMingguan->id) }}"
                    class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                    + Tambah Log Harian
                </a> --}}
            </div>
        @endif
    </div>
@endsection
