{{-- filepath: c:\coolyeah\SEM4\SIGMAGANG-NEW\resources\views\mahasiswa\monitoring\index.blade.php --}}
@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Mingguan</h1>
        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" onclick="location.href='{{ route('mahasiswa.monitoring.create') }}'">Tambah Log
        </button>
    </div>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Tanggal Mingguan</th>
                    <th scope="col" class="px-6 py-3">Minggu Ke</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logMingguan as $key => $log)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="min-w-0">
                                    <div class="font-medium md:text-base break-words truncate md:whitespace-normal">
                                        {{ $log->pengajuan->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($log->tanggal_awal)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($log->tanggal_akhir)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $log->minggu }}
                        </td>
                        <td class="px-6 py-4">
                        <a href="{{ route('mahasiswa.monitoring.show', $log->id) }}"
                        class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                        Detail
                    </a>
                </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Belum ada log mingguan yang diinput.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination jika digunakan -->
        {{-- <div class="p-4">
            {{ $logMingguan->links('pagination::tailwind') }}
        </div> --}}
    </div>
@endsection