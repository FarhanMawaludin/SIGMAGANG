@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Rekomendasi Lowongan</h1>
    </div>

    <div class="flex justify-between items-center mb-4">
        <form class="flex w-full max-w-lg" method="GET" action="{{ route('mahasiswa.lowongan.index') }}">
            <div class="flex w-full">
                <!-- Hidden input to store selected category -->
                <input type="hidden" name="category" id="selected-category" value="{{ $category }}">

                <!-- Dropdown button -->
                <button id="dropdown-menu" type="button" data-dropdown-toggle="dropdownDivider-menu"
                    class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
                    {{ $category === 'terbaru' ? 'Terbaru' : 'Pilih Kategori' }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDivider-menu"
                    class="z-10 hidden absolute mt-12 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li>
                            <button type="button" data-value="terbaru"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Terbaru
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Search input -->
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" name="search"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Cari lowongan berdasarkan nama magang..." value="{{ $search ?? '' }}" />
                    <button type="submit"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d=" m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>

        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
            class="cursor-pointer text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Rekomendasi
            <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M5.23 7.21a.75.75 0 0 1 .97-.07L10 10.293l3.8-3.8a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1-.07-.97Z" />
            </svg>
        </button>

        <div id="loading-spinner"
            class="fixed top-0 left-0 w-full h-full bg-white/40 backdrop-blur-sm flex justify-center items-center z-50 hidden transition-opacity duration-300">
            <div class="flex flex-col items-center space-y-4">
                <img src="{{ asset('images/Logo-Sigmagang.png') }}" alt="Loading Logo" class="w-16 h-20 animate-bounce" />

                <p class="text-lg font-medium text-blue-700">Memproses rekomendasi...</p>
            </div>
        </div>

        <!-- Dropdown Menu -->
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

    {{-- <div id="loading-spinner"
            class="fixed top-0 left-0 w-full h-full bg-white/40 backdrop-blur-sm flex justify-center items-center z-50 hidden transition-opacity duration-300">
            <div class="flex flex-col items-center space-y-4">
                <div class="relative w-12 h-12">
                    <div class="absolute inset-0 border-4 border-blue-500 border-t-transparent rounded-full animate-spin">
                    </div>
                    <div
                        class="absolute inset-0 border-4 border-blue-300 border-t-transparent rounded-full animate-spin-slow">
                    </div>
                </div>
                <p class="text-lg font-medium text-blue-700">Memproses rekomendasi...</p>
            </div>
        </div> --}}



    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @foreach ($lowongan as $item)
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('storage/' . $item->perusahaan->foto) }}" alt="Logo {{ $item->perusahaan->nama }}"
                        class="h-30 w-30 object-contain" />
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

    <script>
        document.querySelectorAll('.rekomendasi-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const spinner = document.getElementById('loading-spinner');
                spinner.classList.remove('hidden');
                spinner.classList.add('opacity-0');
                setTimeout(() => spinner.classList.remove('opacity-0'), 20);

                setTimeout(() => {
                    window.location.href = this.getAttribute('data-href');
                }, 4000);
            });
        });
    </script>

<script>
    const dropdownBtn = document.getElementById('dropdown-menu');
    const dropdownMenu = document.getElementById('dropdownDivider-menu');

    // Toggle dropdown on button click
    dropdownBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (event) => {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Category button click handler
    document.querySelectorAll('.category-btn').forEach(button => {
        button.addEventListener('click', function () {
            const selectedValue = this.getAttribute('data-value');

            // Set hidden input value
            document.getElementById('selected-category').value = selectedValue;

            // Update dropdown button text
            dropdownBtn.childNodes[0].nodeValue = this.textContent.trim();

            // Hide dropdown
            dropdownMenu.classList.add('hidden');

            // Submit the form automatically
            dropdownBtn.closest('form').submit();
        });
    });
</script>
@endsection
