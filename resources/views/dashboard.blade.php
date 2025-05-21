@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4 w-full">
        <div class=" w-full p-4 bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="p-2 rounded-full bg-orange-500 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A4 4 0 0 1 8.6 16h6.8a4 4 0 0 1 3.478 1.804M15 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user_count }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Mahasiswa</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-green-600 dark:text-green-400">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <p class="text-sm text-gray-600 dark:text-gray-300">12 mahasiswa bertambah</p>
            </div>
        </div>
        <div class=" w-full p-4 bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="p-2 rounded-full bg-orange-500 text-white">
                    <svg class="w-6 h-6 " fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $lowongan_count }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Lowongan</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-green-600 dark:text-green-400">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <p class="text-sm text-gray-600 dark:text-gray-300">12 lowongan bertambah</p>
            </div>
        </div>
        <div class=" w-full p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="p-2 rounded-full bg-orange-500 text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pengajuan_count }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Pengajuan</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-green-600 dark:text-green-400">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <p class="text-sm text-gray-600 dark:text-gray-300">12 pengajuan bertambah</p>
            </div>
        </div>
        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="p-2 rounded-full bg-orange-500 text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $perusahaan_count }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Perusahaan</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-green-600 dark:text-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1 text-green-600" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-sm text-gray-600 dark:text-gray-300">Tidak ada penambahan</p>
            </div>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 w-full gap-4 mb-4 items-stretch">
        <div class=" w-full bg-white rounded-lg border border-gray-200 dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between mb-3">
                <div class="flex items-center">
                    <div class="flex justify-center items-center">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Pengajuan Magang
                        </h5>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                <div class="grid grid-cols-3 gap-3 mb-2">
                    <dl class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                            {{ $pending_count }}</dt>
                        <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Menunggu</dd>
                    </dl>
                    <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                            {{ $accepted_count }}</dt>
                        <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Diterima</dd>
                    </dl>
                    <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                        <dt
                            class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                            {{ $rejected_count }}</dt>
                        <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Ditolak</dd>
                    </dl>
                </div>
            </div>

            <!-- Radial Chart -->
            <div class="py-6" id="radial-chart"></div>

            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <!-- Button -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdownpengajuan"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 7 days
                        <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="lastDaysdropdownpengajuan"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 border border-gray-200">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    90 days</a>
                            </li>
                        </ul>
                    </div>
                    {{-- <a href="#"
                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                        Progress report
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a> --}}
                </div>
            </div>
        </div>
        {{-- line chart --}}
        <div class=" w-full h-full bg-white rounded-lg  border border-gray-200 dark:bg-gray-800 ">
            <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
                <div>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah</p>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Mahasiswa Diterima</h5>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-left">
                    <!-- Dropdown Tahun -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="tahunDropdown"
                        data-dropdown-placement="bottom" type="button"
                        class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Tahun
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="tahunDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-gray-200 w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2021</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2022</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2023</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2024</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2025</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="labels-chart" class="px-2.5"></div>
            <div
                class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5 p-4 md:p-6 pt-0 md:pt-0">
                <div class="flex justify-between items-center pt-5">
                    <!-- Button -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 7 days
                        <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="lastDaysdropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 border border-gray-200">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    90 days</a>
                            </li>
                        </ul>
                    </div>
                    {{-- <a href="#"
                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                        Sales Report
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- tabel --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Mahasiswa Menunggu</h1>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 cursor-pointer"
            onclick="location.href='{{ url('pengajuan') }}'">
            Lihat Semua Pengajuan
        </button>
    </div>

    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="w-full text-sm text-left text-gray-700 min-w-[768px]">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Prodi</th>
                    <th class="px-6 py-3">Lowongan</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Dosen Pembimbing</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($pengajuan->isEmpty())
                    <tr class="bg-white border-b border-gray-200">
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pengajuan.
                        </td>
                    </tr>
                @else
                    @foreach ($pengajuan as $index => $item)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="flex items-center gap-3 px-6 py-4">
                                @if ($item->foto)
                                    <img src="{{ asset('images/logo/' . $item->foto) }}" alt="Foto {{ $item->name }}"
                                        class="w-10 h-10 rounded-full object-cover shrink-0">
                                @else
                                    <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                                        class="w-10 h-10 rounded-full border border-gray-200 object-cover shrink-0">
                                @endif
                                <div>
                                    <div class="font-semibold">{{ $item->mahasiswa->user->name ?? 'Nama Tidak Tersedia' }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $item->mahasiswa->nim ?? 'NIM Tidak Tersedia' }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $item->mahasiswa->prodi->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->lowongan->nama ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-orange-100 text-orange-600',
                                        'accepted' => 'bg-green-100 text-green-600',
                                        'rejected' => 'bg-red-100 text-red-600',
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu',
                                        'accepted' => 'Diterima',
                                        'rejected' => 'Ditolak',
                                    ];
                                    $status = strtolower($item->status);
                                @endphp
                                <span
                                    class="{{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-600' }} text-xs font-medium px-3 py-1 rounded-full">
                                    {{ $statusText[$status] ?? ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $item->dosen->user->name ?? '(Belum dipilih)' }}
                            </td>
                            <td class="w-[200px] px-6 py-4">
                                <button
                                    class="inline-flex items-center bg-orange-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-orange-600 transition cursor-pointer"
                                    onclick="window.location.href='{{ route('admin.pengajuan.edit', $item->id) }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Cek Pengajuan
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <script>
        const getChartOptions = () => {
            return {
                series: [
                    {{ $pending_count }},
                    {{ $accepted_count }},
                    {{ $rejected_count }}
                ],
                colors: ["#1C64F2", "#16BDCA", "#FDBA8C"],
                chart: {
                    height: "350",
                    width: "100%",
                    type: "radialBar",
                    sparkline: {
                        enabled: true,
                    },
                },
                plotOptions: {
                    radialBar: {
                        track: {
                            background: '#E5E7EB',
                        },
                        dataLabels: {
                            show: false,
                        },
                        hollow: {
                            margin: 0,
                            size: "32%",
                        }
                    },
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -23,
                        bottom: -20,
                    },
                },
                labels: ["Menunggu", "Diterima", "Ditolak"],
                legend: {
                    show: true,
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                    y: {
                        formatter: function(value) {
                            return value + '%';
                        }
                    },
                    theme: 'light',
                },
                yaxis: {
                    show: false,
                    labels: {
                        formatter: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }

        if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.querySelector("#radial-chart"), getChartOptions());
            chart.render();
        }
    </script>



    <script>
        const options = {
            xaxis: {
                show: true,
                categories: @json($years),
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
            },
            yaxis: {
                show: true,
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400 mb-2'
                    },
                    formatter: function(value) {
                        return value;
                    }
                }
            },
            series: [{
                name: "Accepted",
                data: @json($totals),
                color: "#1A56DB",
            }],
            chart: {
                sparkline: {
                    enabled: false
                },
                height: "72%",
                width: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 3
            },
            markers: {
                size: 4,
                hover: {
                    size: 6
                }
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            },
        }

        document.addEventListener("DOMContentLoaded", function() {
            const chartContainer = document.getElementById("labels-chart");

            if (chartContainer && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(chartContainer, options);
                chart.render();
            } else {
                console.warn("Chart container not found or ApexCharts not loaded");
            }
        });
    </script>
@endsection
