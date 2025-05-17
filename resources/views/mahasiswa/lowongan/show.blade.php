@extends('layouts.mahasiswa-app')

@section('content')
    <div class=" bg-white p-6 px-8 rounded-lg border border-gray-200 mt-4">
        <!-- Header -->
        <div class="flex justify-between  items-center mb-8">
            <div class="flex flex-col items-start gap-1">
                <!-- Logo di atas -->
                <img src="{{ asset('storage/' . $lowongan->perusahaan->foto) }}" alt="Logo {{ $lowongan->perusahaan->nama }}"
                    class="w-28 h-28 object-contain" />

                <!-- Informasi Lowongan -->
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-[26px] font-bold">{{ $lowongan->nama }}</h2>
                        <p class="text-[18px] text-gray-500 font-regular mt-1">{{ $lowongan->perusahaan->nama }}</p>

                        <div class="flex items-center text-sm text-gray-500 mt-4 gap-4">
                            <span class="flex items-center font-medium gap-1">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10c0 7.5-7.5 11.25-7.5 11.25S4.5 17.5 4.5 10a7.5 7.5 0 1115 0z" />
                                </svg>
                                {{ $lowongan->lokasi }}
                            </span>
                            <span class="flex items-center font-medium gap-1">
                                <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                                </svg>
                                {{ $lowongan->tipe_magang }}
                            </span>
                            <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-medium">
                                {{ $lowongan->jenismagang->jenis_magang }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Button -->
            <div class="text-right flex flex-col items-center">
                <a href="#"
                    class="bg-blue-600 font-semibold text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">Daftar
                    Sekarang</a>
                <p class="text-sm text-gray-500 mt-2">{{ $lowongan->jumlah_magang }} Posisi •
                    {{ $lowongan->pengajuan_count }} Pelamar</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-4">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabExample" data-tabs-toggle="#tabContent"
                role="tablist">
                <li class="me-2">
                    <button id="desc-tab" data-tabs-target="#desc" type="button" role="tab" aria-controls="desc"
                        aria-selected="true"
                        class="inline-block p-2 rounded-lg aria-selected:bg-blue-50 aria-selected:text-blue-600 aria-[selected=false]:bg-gray-100 aria-[selected=false]:text-gray-400">
                        Deskripsi
                    </button>
                </li>
                <li class="me-2">
                    <button id="company-tab" data-tabs-target="#company" type="button" role="tab"
                        aria-controls="company" aria-selected="false"
                        class="inline-block p-2 rounded-lg aria-selected:bg-blue-50 aria-selected:text-blue-600 aria-[selected=false]:bg-gray-100 aria-[selected=false]:text-gray-400">
                        Perusahaan
                    </button>
                </li>
            </ul>
        </div>


        <hr class="mb-4 border-gray-200">

        <!-- Content -->
        <div id="tabContent">
            <div id="desc" role="tabpanel" aria-labelledby="desc-tab">
                <!-- Pendidikan -->
                <div class="mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-gray-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.78552 9.5 12.7855 14l9-4.5-9-4.5-8.99998 4.5Zm0 0V17m3-6v6.2222c0 .3483 2 1.7778 5.99998 1.7778 4 0 6-1.3738 6-1.7778V11" />
                        </svg>
                        <div>
                            <h3 class="font-semibold  text-lg mb-1">Pendidikan</h3>
                            <p class="text-gray-500 mb-1">Jurusan: <span
                                    class="font-medium text-gray-950">{{ $lowongan->prodi->nama }}</span></p>
                            <p class="text-gray-500">IPK Minimal: <span class="font-medium text-gray-950">3.0</span></p>
                        </div>
                    </div>
                </div>

                <!-- Skill -->
                <div class="mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18.5A2.493 2.493 0 0 1 7.51 20H7.5a2.468 2.468 0 0 1-2.4-3.154 2.98 2.98 0 0 1-.85-5.274 2.468 2.468 0 0 1 .92-3.182 2.477 2.477 0 0 1 1.876-3.344 2.5 2.5 0 0 1 3.41-1.856A2.5 2.5 0 0 1 12 5.5m0 13v-13m0 13a2.493 2.493 0 0 0 4.49 1.5h.01a2.468 2.468 0 0 0 2.403-3.154 2.98 2.98 0 0 0 .847-5.274 2.468 2.468 0 0 0-.921-3.182 2.477 2.477 0 0 0-1.875-3.344A2.5 2.5 0 0 0 14.5 3 2.5 2.5 0 0 0 12 5.5m-8 5a2.5 2.5 0 0 1 3.48-2.3m-.28 8.551a3 3 0 0 1-2.953-5.185M20 10.5a2.5 2.5 0 0 0-3.481-2.3m.28 8.551a3 3 0 0 0 2.954-5.185" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-950  text-lg mb-1">Kemampuan Pendukung</h3>
                            @if ($lowongan->skill->count() > 0)
                                <ul class="list-disc list-inside font-medium text-[15px] text-gray-700 space-y-1 mt-2">
                                    @foreach ($lowongan->skill as $skill)
                                        <li>{{ $skill->nama }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-400 italic">Belum ada kemampuan yang ditentukan.</p>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-blue-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 8h6m-6-4h6m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-blue-600 text-lg mb-1">Dokumen</h3>
                            <p class="font-medium text-gray-950">{{ $lowongan->persyaratan }}</p>

                        </div>
                    </div>
                </div>

                <hr class="mb-4 border-gray-200">

                <!-- Informasi Penting -->
                <div class="mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <div>
                            <h3 class="font-semibold text-yellow-500  text-lg mb-1">Informasi Penting</h3>
                            <p class="text-gray-500 mb-1">Penutupan: <span
                                    class="font-medium text-gray-950">{{ \Carbon\Carbon::parse($lowongan->batas_pendaftaran)->translatedFormat('d F Y') }}</span>
                            </p>
                            <p class="text-gray-500">Jenis Magang: <span
                                    class="font-medium text-gray-950">{{ $lowongan->jenismagang->jenis_magang }}</span>
                            </p>
                        </div>
                    </div>
                </div>


                <!-- Rincian Lowongan -->
                <div>
                    <h3 class="font-semibold text-lg mb-2">Rincian Lowongan</h3>
                    <p class="text-sm text-gray-700">
                        {{ $lowongan->deskripsi }}
                    </p>
                </div>
            </div>

            <!-- Perusahaan -->
            <div id="company" class="hidden" role="tabpanel" aria-labelledby="company-tab">
                <div class="  space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">Tentang Perusahaan</h2>
                    <!-- Deskripsi -->
                    <p class="text-gray-500 text-base">
                        Perusahaan teknologi terkemuka di Indonesia yang berfokus pada pengembangan software dan solusi
                        digital.
                    </p>

                    <!-- Info Tambahan -->
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 text-gray-600 text-sm">
                        <!-- Kategori -->
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                            </svg>
                            <span>Cyber Security</span>
                        </div>

                        <!-- Link Website -->
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                            </svg>

                            <a href="https://KAIINDONESIA.co.id" target="_blank" class="text-blue-500 hover:underline">
                                https://KAIINDONESIA.co.id
                            </a>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <a href="#"
                        class="inline-flex items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg mt-2">
                        Lihat Profil Lengkap
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <hr class="mb-4 mt-4 border-gray-200">

                <h2 class="text-xl font-bold text-gray-900 mb-4">Ulasan Pemagang</h2>
                <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4 flex items-start space-x-4">
                    <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Avatar Farhan"
                        class="w-10 h-10 rounded-full object-cover" />
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Farhan Mawaludin</h3>
                        <p class="text-sm text-gray-500">Internship KAI 2025 – IT Department</p>
                        <p class="mt-2 text-gray-600 text-sm">senang dan alhamdulillah bisa berkembang dengan pengetahuan
                            baru
                            yang belum pernah saya dapatkan sebelumnya</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4 flex items-start space-x-4">
                    <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Avatar Siti"
                        class="w-10 h-10 rounded-full object-cover" />
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Siti Markona</h3>
                        <p class="text-sm text-gray-500">Internship KAI 2025 – IT Department</p>
                        <p class="mt-2 text-gray-600 text-sm">senang dan alhamdulillah bisa berkembang dengan pengetahuan
                            baru
                            yang belum pernah saya dapatkan sebelumnya</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4 flex items-start space-x-4">
                    <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Avatar Markova"
                        class="w-10 h-10 rounded-full object-cover" />
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Markova</h3>
                        <p class="text-sm text-gray-500">Internship KAI 2025 – IT Department</p>
                        <p class="mt-2 text-gray-600 text-sm">senang dan alhamdulillah bisa berkembang dengan pengetahuan
                            baru
                            yang belum pernah saya dapatkan sebelumnya</p>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-center mt-6">
                    <a href="#"
                        class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
