@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Rekomendasi Lowongan</h1>
        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
            class="cursor-pointer text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Rekomendasi
            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M5.23 7.21a.75.75 0 0 1 .97-.07L10 10.293l3.8-3.8a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1-.07-.97Z" />
            </svg>
        </button>
        <div id="dropdownDivider"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                <li>
                    <a href="{{ route('mahasiswa.rekomendasi.index') }}"
                        class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rekomendasi-link"
                        data-href="{{ route('mahasiswa.rekomendasi.index') }}">
                        Rekomendasi Swara
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.rekomendasi.fuzzy') }}"
                        class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rekomendasi-link"
                        data-href="{{ route('mahasiswa.rekomendasi.fuzzy') }}">
                        Rekomendasi Fuzzy
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- @if ($pengajuan)
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <p class="font-medium">
                    Anda telah mengajukan magang di <b>{{ $pengajuan->lowongan->perusahaan->nama }}</b>
                    pada <b>{{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y') }}</b>
                    (Status: <b>{{ ucfirst($pengajuan->status) }}</b>)
                </p>
            </div>
        </div>
    @elseif ($lowongan->isEmpty())
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <p class="font-medium">
                    Belum ada lowongan magang yang tersedia.
                </p>
            </div>
        </div>
    @else --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @foreach ($lowongan as $item)
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('storage/' . $item->perusahaan->foto) }}" alt="Logo {{ $item->perusahaan->nama }}"
                        class="h-28">
                    <h2 class="text-[14px] font-medium text-gray-400 mb-2">{{ $item->perusahaan->nama }}</h2>
                    <h3 class="text-[18px] font-semibold text-mirage-950 leading-snug mb-2">
                        {{ $item->nama }}
                    </h3>

                    <div class="flex items-center font-medium text-[14px] text-gray-400 mb-1">
                        <span>{{ $item->lokasi }}</span>
                    </div>

                    <div class="flex items-center text-[14px] font-reguler text-mirage-950 mb-3">
                        <span>{{ $item->jumlah_magang }} Posisi</span>
                        <span class="mx-1">•</span>
                        <span>{{ $item->pengajuan_count }} Pelamar</span>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-green-100 text-green-600 text-xs font-medium px-3 py-1 rounded-full">{{ $item->jenismagang->jenis_magang }}</span>
                        <span
                            class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">{{ $item->tipe_magang }}</span>
                    </div>

                    <hr class="mb-4 border-gray-200">

                    <div class="text-sm mb-4">
                        <span class="font-medium text-[14px] text-gray-400">Penutupan :</span>
                        <span class="text-red-500 font-semibold">
                            {{ \Carbon\Carbon::parse($item->batas_pendaftaran)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2 font-reguler text-gray-500 text-xs bg-gray-100 p-2 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        <span>{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('mahasiswa.lowongan.show', $item->id) }}">
                        <button type="button"
                            class="w-full text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out cursor-pointer">
                            Lihat Detail
                        </button>
                    </a>

                </div>
            </div>
        @endforeach
    </div>
    {{-- @endif --}}

    <script>
        const profilLengkap = @json($profilLengkap);

        document.querySelectorAll('.rekomendasi-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!profilLengkap) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Profil Belum Lengkap',
                        text: 'Anda harus melengkapi profil sebelum menggunakan fitur rekomendasi.',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Isi Profil Sekarang',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('mahasiswa.profil.index') }}";
                        }
                    });
                }
            });
        });
    </script>
@endsection
