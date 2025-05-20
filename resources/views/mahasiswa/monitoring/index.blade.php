@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas</h1>
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
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $key => $log)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                {{-- Nama mahasiswa dari relasi --}}
                                <div class="min-w-0">
                                    <div class="font-medium md:text-base break-words truncate md:whitespace-normal">
                                        {{ $log->logMingguan->pengajuan->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->tanggal)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-600">
                                Aktif
                            </span>
                        </td>
                        {{-- <td class="px-6 py-4 space-x-2">
                            <!-- Tombol tambah log harian -->
                            <a href="{{ route('mahasiswa.monitoring.create') }}"
                                class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="hidden md:inline">Unggah Log</span>
                            </a>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada log harian yang diinput.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination jika digunakan -->
        {{-- <div class="p-4">
            {{ $logs->links('pagination::tailwind') }}
        </div> --}}
    </div>
@endsection
