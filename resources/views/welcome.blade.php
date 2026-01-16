<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigmagang - Landing Page</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo-Sigmagang.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-white">
    <!-- Navbar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-900 shadow-sm sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/Logo-Sigmagang.png') }}" class="h-8" alt="Sigmagang Logo" />
                <span class="text-[20px] font-bold text-orange-500 mr-12">SIGMAGANG</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <div class="flex items-center gap-2">
                    <button type="button"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        onclick="location.href='{{ route('login') }}'">
                        Masuk
                    </button>
                    <button type="button"
                        class="text-blue-500 bg-white border border-blue-600 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        onclick="location.href='{{ route('register') }}'">
                        Buat Akun
                    </button>
                </div>
                <button data-collapse-toggle="navbar-cta" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-left justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul id="menu"
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#beranda"
                            class="block py-2 px-3 md:p-0 rounded-sm text-blue-600 md:text-blue-600 md:dark:text-blue-500"
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="#fitur"
                            class="block py-2 px-3 md:p-0 rounded-sm text-gray-400 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Fitur</a>
                    </li>
                    <li>
                        <a href="#panduan"
                            class="block py-2 px-3 md:p-0 rounded-sm text-gray-400 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Panduan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="relative px-6 py-12 md:py-12 max-w-7xl mx-auto overflow-hidden flex flex-col-reverse md:flex-row items-center gap-10"
        id="beranda">

        <!-- Teks -->
        <div class="w-full md:w-1/2 relative z-10 text-center md:text-left" data-aos="fade-right"
            data-aos-duration="1000" data-aos-once="true">
            <h1 class="text-3xl sm:text-4xl md:text-[50px] text-mirage-950 font-extrabold leading-snug space-y-2">
                <div>Temukan Magang</div>
                <div class="mt-24">Sesuai Minat dan</div>
                <div class="mt-12">
                    <span class="text-blue-600">Keahlianmu!</span>
                </div>
            </h1>
            <p class="text-gray-400 font-normal text-base  sm:text-[16px] mt-4">
                Sistem Rekomendasi Magang untuk Mahasiswa <br class="hidden sm:block">Jurusan Teknologi Informasi
            </p>
            <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 mt-6">
                <button
                    class="bg-blue-600 text-white px-6 py-3 font-semibold rounded-md text-sm hover:bg-blue-800 transition-all duration-300 ease-in-out"
                    onclick="location.href='{{ route('login') }}'">
                    Mulai Sekarang
                </button>
                <a href="#panduan">
                    <button
                        class="border border-blue-300 text-blue-600 text-sm px-6 py-3 font-semibold rounded-md hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">
                        Pelajari lebih lanjut
                    </button>
                </a>

            </div>
        </div>

        <!-- Gambar -->
        <div class="w-full md:w-1/2" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="100">
            <div class="relative mx-auto max-w-[400px] md:max-w-[600px]">
                <img src="{{ asset('images/landing Page 1.png') }}" alt="Team" class="w-full h-auto" />
            </div>
        </div>
    </section>


    <section class="py-16 bg-white">
        <!-- Baris Logo 1: Scroll ke kiri -->
        <div class="overflow-hidden mb-6">
            <div class="flex animate-scroll-left gap-16">
                <img src="{{ asset('images/logo/kai.png') }}" alt="KAI" class="h-32">
                <img src="{{ asset('images/logo/pln.png') }}" alt="PLN" class="h-32">
                <img src="{{ asset('images/logo/pertamina.png') }}" alt="Pertamina" class="h-32">
                <img src="{{ asset('images/logo/inka.png') }}" alt="INKA" class="h-32">
                <img src="{{ asset('images/logo/perumnas.png') }}" alt="Perumnas" class="h-32">
                <img src="{{ asset('images/logo/kai.png') }}" alt="KAI" class="h-32">
                <img src="{{ asset('images/logo/pln.png') }}" alt="PLN" class="h-32">
                <img src="{{ asset('images/logo/pertamina.png') }}" alt="Pertamina" class="h-32">
                <img src="{{ asset('images/logo/inka.png') }}" alt="INKA" class="h-32">
                <img src="{{ asset('images/logo/perumnas.png') }}" alt="Perumnas" class="h-32">
            </div>
        </div>

        <!-- Baris Logo 2: Scroll ke kanan -->
        <div class="overflow-hidden">
            <div class="flex animate-scroll-right gap-16">
                <img src="{{ asset('images/logo/kai.png') }}" alt="KAI" class="h-32">
                <img src="{{ asset('images/logo/pln.png') }}" alt="PLN" class="h-32">
                <img src="{{ asset('images/logo/pertamina.png') }}" alt="Pertamina" class="h-32">
                <img src="{{ asset('images/logo/inka.png') }}" alt="INKA" class="h-32">
                <img src="{{ asset('images/logo/perumnas.png') }}" alt="Perumnas" class="h-32">
                <img src="{{ asset('images/logo/kai.png') }}" alt="KAI" class="h-32">
                <img src="{{ asset('images/logo/pln.png') }}" alt="PLN" class="h-32">
                <img src="{{ asset('images/logo/pertamina.png') }}" alt="Pertamina" class="h-32">
                <img src="{{ asset('images/logo/inka.png') }}" alt="INKA" class="h-32">
                <img src="{{ asset('images/logo/perumnas.png') }}" alt="Perumnas" class="h-32">
            </div>
        </div>
    </section>


    <!-- Fitur -->
    <section class="px-6 py-16 bg-gray-50" id="fitur">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up" data-aos-duration="800">
            <h2 class="text-[28px] font-bold">
                Cari Magang Sesuai Kompetensimu, <span class="text-orange-500">Tanpa Ribet</span>
            </h2>
            <p class="text-gray-500 text-[14px] mt-2 font-regular">
                Platform rekomendasi magang Polinema hadir untuk memudahkanmu menemukan tempat magang sesuai keahlian,
                minat, dan tujuan karirmu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow text-center hover:border-2 border-blue-600" data-aos="zoom-in"
                data-aos-duration="600" data-aos-delay="100">
                <img src="{{ asset('images/Rekomendasi.png') }}" alt="Otomatis" class="h-32 mx-auto mb-6">
                <h3 class="text-[20px] text-mirage-950 font-bold">Rekomendasi Magang Otomatis</h3>
                <p class="text-sm text-gray-500 mt-2">Sistem akan mencocokkan lowongan magang dengan profil mahasiswa
                    (kompetensi, lokasi, minat, keahlian).
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center hover:border-2 border-blue-600" data-aos="zoom-in"
                data-aos-duration="600" data-aos-delay="200">
                <img src="{{ asset('images/Logbook.png') }}" alt="Logbook" class="h-32 mx-auto mb-6">
                <h3 class="text-[20px] text-mirage-950 font-bold">Logbook & Evaluasi Magang</h3>
                <p class="text-sm text-gray-500 mt-2">Mahasiswa bisa mencatat kegiatan magang (harian/mingguan) dan
                    memberikan feedback setelah selesai.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center hover:border-2 border-blue-600" data-aos="zoom-in"
                data-aos-duration="600" data-aos-delay="300">
                <img src="{{ asset('images/Sertifikat.png') }}" alt="Sertifikat" class="h-32 mx-auto mb-6">
                <h3 class="text-[20px] text-mirage-950 font-bold">Unduh Sertifikat & Dokumen</h3>
                <p class="text-sm text-gray-500 mt-2">mahasiswa dapat mengunduh sertifikat dan dokumen penting terkait
                    kegiatan magang merekadengan mudah dan cepat.
                </p>
            </div>
        </div>
    </section>

    <!-- Lowongan Terpopuler -->
    {{-- <section class="px-6 py-16">
        <div class="text-center mb-12">
            <h2 class="text-[28px] font-bold">Lowongan Magang <span class="text-orange-500">Terpopuler</span></h2>
            <p class="text-gray-600 text-sm mt-2">Beberapa lowongan yang paling diminati oleh mahasiswa saat ini.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('images/Logo/KAI.png') }}" alt="KAI Logo" class="h-20 mb-1">
                    <h2 class="text-[14px] font-medium text-gray-400 mb-2">PT Kereta Api Indonesia (Persero)</h2>
                    <h3 class="text-[18px] font-semibold text-mirage-950 leading-snug mb-4">
                        Internship KAI 2025 – IT Department,<br>Open for Informatics Engineering Students
                    </h3>

                    <div class="flex items-center font-medium text-[14px] text-gray-400 mb-1">
                        <span>Kota Madiun</span>
                    </div>

                    <div class="flex items-center text-[14px] font-reguler text-mirage-950 mb-3">
                        <span>5 Posisi</span>
                        <span class="mx-1">•</span>
                        <span>20 Pelamar</span>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-green-100 text-green-600 text-xs font-medium px-3 py-1 rounded-full">Umum</span>
                        <span class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">6
                            Bulan</span>
                        <span
                            class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">Onsite</span>
                    </div>

                    <hr class="my-4">

                    <div class="text-sm mb-4">
                        <span class="font-medium text-[14px] text-gray-400">Penutupan :</span>
                        <span class="text-red-500 font-semibold">30 April 2025</span>
                    </div>

                    <div
                        class="flex items-center gap-2 font-reguler text-gray-500 text-xs bg-gray-100 p-2 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        <span>Dibuat 2 hari yang lalu</span>
                    </div>

                    <button type="button"
                        class="w-full text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
                        Lihat Detail
                    </button>
                </div>
            </div>
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('images/Logo/Gresik.png') }}" alt="KAI Logo" class="h-20 mb-1">
                    <h2 class="text-[14px] font-medium text-gray-400 mb-2">PT Petrokimia Gresik</h2>
                    <h3 class="text-[18px] font-semibold text-mirage-950 leading-snug mb-4">
                        Internship Petrokimia 2025 – IT Department,<br>Open for Informatics Engineering Students
                    </h3>

                    <div class="flex items-center font-medium text-[14px] text-gray-400 mb-1">
                        <span>Kota Gresik</span>
                    </div>

                    <div class="flex items-center text-[14px] font-reguler text-mirage-950 mb-3">
                        <span>25 Posisi</span>
                        <span class="mx-1">•</span>
                        <span>5 Pelamar</span>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-green-100 text-green-600 text-xs font-medium px-3 py-1 rounded-full">Umum</span>
                        <span class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">6
                            Bulan</span>
                        <span
                            class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">Onsite</span>
                    </div>

                    <hr class="my-4">

                    <div class="text-sm mb-4">
                        <span class="font-medium text-[14px] text-gray-400">Penutupan :</span>
                        <span class="text-red-500 font-semibold">30 April 2025</span>
                    </div>

                    <div
                        class="flex items-center gap-2 font-reguler text-gray-500 text-xs bg-gray-100 p-2 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        <span>Dibuat 2 hari yang lalu</span>
                    </div>

                    <button type="button"
                        class="w-full text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
                        Lihat Detail
                    </button>
                </div>
            </div>
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('images/Logo/KimiaFarma.png') }}" alt="KAI Logo" class="h-20 mb-1">
                    <h2 class="text-[14px] font-medium text-gray-400 mb-2">Kimia Farma (Persero) Tbk</h2>
                    <h3 class="text-[18px] font-semibold text-mirage-950 leading-snug mb-4">
                        Internship Kimia Farma 2025 – IT Department,<br>Open for Informatics Engineering Students
                    </h3>

                    <div class="flex items-center font-medium text-[14px] text-gray-400 mb-1">
                        <span>Kota Madiun</span>
                    </div>

                    <div class="flex items-center text-[14px] font-reguler text-mirage-950 mb-3">
                        <span>2 Posisi</span>
                        <span class="mx-1">•</span>
                        <span>10 Pelamar</span>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-green-100 text-green-600 text-xs font-medium px-3 py-1 rounded-full">Umum</span>
                        <span class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">6
                            Bulan</span>
                        <span
                            class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">Onsite</span>
                    </div>

                    <hr class="my-4">

                    <div class="text-sm mb-4">
                        <span class="font-medium text-[14px] text-gray-400">Penutupan :</span>
                        <span class="text-red-500 font-semibold">30 April 2025</span>
                    </div>

                    <div
                        class="flex items-center gap-2 font-reguler text-gray-500 text-xs bg-gray-100 p-2 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        <span>Dibuat 2 hari yang lalu</span>
                    </div>

                    <button type="button"
                        class="w-full text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
                        Lihat Detail
                    </button>
                </div>
            </div>
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('images/Logo/BUMN.png') }}" alt="KAI Logo" class="h-20 mb-1">
                    <h2 class="text-[14px] font-medium text-gray-400 mb-2">Badan Usaha Milik Negara</h2>
                    <h3 class="text-[18px] font-semibold text-mirage-950 leading-snug mb-4 ">
                        Internship BUMN 2025 – IT Department,<br>Open for Informatics Engineering Students
                    </h3>

                    <div class="flex items-center font-medium text-[14px] text-gray-400 mb-1">
                        <span>Kota Jakarta Selatan</span>
                    </div>

                    <div class="flex items-center text-[14px] font-reguler text-mirage-950 mb-3">
                        <span>10 Posisi</span>
                        <span class="mx-1">•</span>
                        <span>20 Pelamar</span>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span
                            class="bg-green-100 text-green-600 text-xs font-medium px-3 py-1 rounded-full">Umum</span>
                        <span class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">6
                            Bulan</span>
                        <span
                            class="bg-gray-200 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">Onsite</span>
                    </div>

                    <hr class="my-4">

                    <div class="text-sm mb-4">
                        <span class="font-medium text-[14px] text-gray-400">Penutupan :</span>
                        <span class="text-red-500 font-semibold">30 April 2025</span>
                    </div>

                    <div
                        class="flex items-center gap-2 font-reguler text-gray-500 text-xs bg-gray-100 p-2 rounded-lg mb-4">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        <span>Dibuat 2 hari yang lalu</span>
                    </div>

                    <button type="button"
                        class="w-full text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
                        Lihat Detail
                    </button>
                </div>
            </div>
        </div>
        <div class="text-center mt-10">
            <button type="button"
                class="flex items-center mx-auto gap-2 text-blue-600 bg-white border border-blue-500 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"">
                Lihat Lebih Banyak
                <svg class="w-6 h-6 text-current group-hover:text-white transition-all duration-300 ease-in-out"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </button>
        </div>
    </section> --}}

    <!-- 5 Langkah Magang -->
    <section class="bg-blue-500 py-12 px-6" id="panduan">
        <div class="max-w-7xl mx-auto">
            <!-- H2 di tengah atas -->
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-white">
                5 Langkah, Langsung Magang!
            </h2>

            <div class="flex flex-col md:flex-row items-center gap-10">
                <!-- Image -->
                <div class="flex justify-center md:w-1/2">
                    <img src="{{ asset('images/Panduan.png') }}" alt="5 Langkah Magang" class="w-full max-w-md">
                </div>

                <!-- Steps -->
                <div class="md:w-1/2 text-white">
                    <div class="flex flex-col gap-4">

                        <!-- Step 1 -->
                        <div class="bg-blue-400 rounded-lg p-4 flex items-center gap-4 shadow-md" data-aos="zoom-in"
                            data-aos-delay="100">
                            <div
                                class="flex-shrink-0 w-10 h-10 min-w-10 min-h-10 aspect-square rounded-full bg-white flex items-center justify-center text-blue-600 font-bold text-lg">
                                1
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Login ke akun</h3>
                                <p class="text-sm font-regular">Masuk ke akun kamu. Belum punya akun? Daftar dulu ya!
                                </p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-blue-400 rounded-lg p-4 flex items-center gap-4 shadow-md" data-aos="zoom-in"
                            data-aos-delay="200">
                            <div
                                class="flex-shrink-0 w-10 h-10 min-w-10 min-h-10 aspect-square rounded-full bg-white flex items-center justify-center text-blue-600 font-bold text-lg">
                                2
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Lengkapi profil kamu</h3>
                                <p class="text-sm font-regular">Isi data diri, keahlian, minat, lokasi favorit, dan
                                    upload dokumen
                                    penting kayak CV atau sertifikat.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-blue-400 rounded-lg p-4 flex items-center gap-4 shadow-md" data-aos="zoom-in"
                            data-aos-delay="300">
                            <div
                                class="flex-shrink-0 w-10 h-10 min-w-10 min-h-10 aspect-square rounded-full bg-white flex items-center justify-center text-blue-600 font-bold text-lg">
                                3
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Lihat rekomendasi magang</h3>
                                <p class="text-sm font-regular">Sistem akan kasih daftar magang yang cocok banget sama
                                    profil kamu.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="bg-blue-400 rounded-lg p-4 flex items-center gap-4 shadow-md" data-aos="zoom-in"
                            data-aos-delay="400">
                            <div
                                class="flex-shrink-0 w-10 h-10 min-w-10 min-h-10 aspect-square rounded-full bg-white flex items-center justify-center text-blue-600 font-bold text-lg">
                                4
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Ajukan lamaran dan pantau statusnya</h3>
                                <p class="text-sm font-regular">Klik magang yang kamu minati, kirim lamaran langsung
                                    dari sistem,
                                    lalu pantau statusnya secara real-time.</p>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div class="bg-blue-400 rounded-lg p-4 flex items-center gap-4 shadow-md" data-aos="zoom-in"
                            data-aos-delay="500">
                            <div
                                class="flex-shrink-0 w-10 h-10 min-w-10 min-h-10 aspect-square rounded-full bg-white flex items-center justify-center text-blue-600 font-bold text-lg">
                                5
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Lakukan magang, isi logbook, dan dapatkan sertifikat</h3>
                                <p class="text-sm ">Isi logbook rutin selama magang, upload laporan, dan dapatkan
                                    sertifikat setelah selesai.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
<<<<<<< Updated upstream
        </div>
    </body>
=======
    </section>


    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 py-6 border-t mt-16">
        © 2025 Sigmagang. Semua hak dilindungi.
    </footer>

    <script>
        const links = document.querySelectorAll('#menu a');

        links.forEach(link => {
            link.addEventListener('click', function() {
                // Reset semua ke style nonaktif
                links.forEach(l => {
                    l.classList.remove('text-blue-600', 'md:text-blue-600',
                    'md:dark:text-blue-500');
                    l.classList.add('text-gray-400');
                });

                // Tambah class aktif ke yang diklik
                this.classList.add('text-blue-600', 'md:text-blue-600', 'md:dark:text-blue-500');
                this.classList.remove('text-gray-400');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            offset: 100,
            once: false // agar animasi bisa muncul lagi saat discroll naik turun
        });
    </script>



</body>

>>>>>>> 3ed8ec3d25880a66ad236bcb4f5d73b2513d0a35
</html>
=======
    </section>


    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 py-6 border-t mt-16">
        © 2025 Sigmagang. Semua hak dilindungi.
    </footer>

    <script>
        const links = document.querySelectorAll('#menu a');

        links.forEach(link => {
            link.addEventListener('click', function() {
                // Reset semua ke style nonaktif
                links.forEach(l => {
                    l.classList.remove('text-blue-600', 'md:text-blue-600',
                    'md:dark:text-blue-500');
                    l.classList.add('text-gray-400');
                });

                // Tambah class aktif ke yang diklik
                this.classList.add('text-blue-600', 'md:text-blue-600', 'md:dark:text-blue-500');
                this.classList.remove('text-gray-400');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            offset: 100,
            once: false // agar animasi bisa muncul lagi saat discroll naik turun
        });
    </script>



</body>

</html>
>>>>>>> Stashed changes
