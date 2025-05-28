{{-- filepath: c:\coolyeah\SEM4\SIGMAGANG-NEW\resources\views\mahasiswa\monitoring\index.blade.php --}}
@extends('layouts.mahasiswa-app')

@section('content')
    @if (!$pengajuan)
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <p class="font-medium">
                    Anda belum mengajukan magang.
                </p>
            </div>
        </div>
    @else
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 whitespace-nowrap">Log Mingguan</h1>
            @if ($pengajuan->status == 'completed')
                <div class="flex justify-end gap-2 w-full">
                    <a href="{{ route('mahasiswa.monitoring.surat_keterangan_magang', $pengajuan->id) }}"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Download Surat Keterangan
                        Magang</a>
                    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        type="button" onclick="location.href='{{ route('mahasiswa.monitoring.review') }}'">Tambakan review
                    </button>
                    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" onclick="noLog()">Tambah Log
                    </button>
                </div>
            @else
                <div class="flex justify-end gap-2 w-full">
                    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button" onclick="location.href='{{ route('mahasiswa.monitoring.create') }}'">Tambah Log
                    </button>
                    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        type="button" onclick="confirmSelesaiMagang()">Selesaikan Magang
                    </button>
                </div>
            @endif
        </div>
        <div class="overflow-x-auto relative rounded-lg border border-gray-200">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Tanggal Mingguan</th>
                        <th scope="col" class="px-6 py-3">Minggu Ke</th>
                        <th scope="col" class="px-6 py-3">Dosen Pembimbing</th>
                        <th scope="col" class="px-6 py-3">Feedback</th>
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
                                {{ $log->pengajuan->dosen->user->name ?? 'Dosen Tidak Ditemukan' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $log->dosen_feedback ?? 'Belum ada feedback' }}
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    class="inline-flex items-center bg-blue-600 text-white  px-4 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer"
                                    onclick="location.href='{{ route('mahasiswa.monitoring.show', $log->id) }}'">
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
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Belum ada log mingguan yang diinput.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $logMingguan->links('pagination::tailwind') }}
            </div>
        </div>
    @endif
    <!-- Pagination jika digunakan -->
    {{-- <div class="p-4">
            {{ $logMingguan->links('pagination::tailwind') }}
        </div> --}}
    </div>
    <script>
        function confirmSelesaiMagang() {
            Swal.fire({
                title: 'Selesaikan Magang?',
                text: "Setelah ini kamu tidak bisa menambah log baru.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('mahasiswa.monitoring.selesai') }}";
                }
            })
        }

        function noLog() {
            Swal.fire({
                title: 'Error',
                text: "kamu sudah menyelesaikan magang.",
                icon: 'error',
                cancelButtonColor: '#d33',
                icon: 'warning',
            })
        }
    </script>
@endsection
