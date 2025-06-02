@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KOLUM KIRI (span 2 kolom) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Jumlah Mahasiswa Diterima -->
            <div class=" w-full h-auto bg-white rounded-lg  border border-gray-200 dark:bg-gray-800 z-100">
                <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
                    <div>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah</p>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Mahasiswa Diterima
                        </h5>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Button PDF -->
                        {{-- <button
                            class="flex items-center gap-1 text-sm font-medium px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">
                            <!-- PDF Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6" />
                            </svg>
                            PDF
                        </button>

                        <!-- Button Excel -->
                        <button
                            class="flex items-center gap-1 text-sm font-medium px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                            <!-- Excel Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4h16v16H4V4zm4 5l4 6m0-6l-4 6" />
                            </svg>
                            Excel
                        </button> --}}
                        <!-- Dropdown Tahun -->
                        <button id="dropdownDefaultButton" data-dropdown-toggle="tahunDropdown"
                            data-dropdown-placement="bottom" type="button"
                            class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            {{ $selectedYear ?? 'Semua' }}
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="tahunDropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg border border-gray-200 w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="{{ url()->current() }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ $selectedYear === null ? 'font-bold text-blue-600' : '' }}">
                                        Semua Tahun
                                    </a>
                                </li>
                                @foreach ($years as $year)
                                    <li>
                                        <a href="{{ url()->current() }}?year={{ $year }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white
                                        {{ $year == $selectedYear ? 'font-bold text-blue-600' : '' }}">
                                            {{ $year }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="labels-chart" class="px-2.5"></div>
            </div>


            <!-- Tren Skill Mahasiswa -->
            <div class="bg-white rounded-xl p-6 border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Tren</p>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Skill Mahasiswa
                        </h5>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <!-- Kolom Kiri: Chart -->
                    <div class="flex justify-center">
                        <div class="py-6" id="pie-chart"></div>
                    </div>

                    <!-- Kolom Kanan: Daftar -->
                    <div class="flex items-center">
                        <ul id="custom-legend" class="text-sm space-y-3 font-normal"></ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLUM KANAN -->
        <div class="space-y-6">

            <!-- Dosen Pembimbing -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 flex items-start gap-3">
                <div class="flex items-center space-x-6">
                    <div class="p-[12px] rounded-full bg-orange-500 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A4 4 0 0 1 8.6 16h6.8a4 4 0 0 1 3.478 1.804M15 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $dosen_count }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Dosen Pembimbing</p>
                    </div>
                </div>
            </div>

            <!-- Ratio Dosen Pembimbing -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 p-y-8">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ratio</p>
                        <h5 class="leading-none text-xl font-bold text-gray-900 dark:text-white pb-2">Dosen Pembimbing
                        </h5>
                    </div>
                </div>

                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                <div class="flex justify-between items-center gap-8 mt-1 mb-4">
                    <!-- Mahasiswa Magang -->
                    <div class="flex items-center gap-2">
                        <div class="text-2xl font-bold text-gray-900">{{ $mahasiswa_dibimbing_count }}</div>
                        <div class="text-sm text-gray-500">Mahasiswa Magang</div>
                    </div>

                    <!-- Rata-rata mahasiswa per Dosen -->
                    <div class="flex items-center gap-2 text-left">
                        <div class="text-2xl font-bold text-gray-900">{{ $ratio_mahasiswa_per_dosen }}</div>
                        <div class="text-sm text-gray-500">Mahasiswa per Dosen</div>
                    </div>
                </div>

                <div class="flex items-center space-x-2 pt-2 mb-1">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    <span class="text-sm font-medium text-gray-700">Total Mahasiswa</span>
                </div>

                <!-- Data Dosen -->
                <div class="space-y-6 pt-2 mb-2">
                    @foreach ($dosen as $item)
                        @php
                            $percentage =
                                $max_mahasiswa > 0
                                    ? number_format(($item->jumlah_mahasiswa / $max_mahasiswa) * 100, 2)
                                    : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between items-center mb-1 text-sm text-gray-900 font-medium">
                                <span>{{ $item->name }}</span>
                                <span>{{ $item->jumlah_mahasiswa }} mahasiswa</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Statistik Kepuasan Rekomendasi -->
            <div class="bg-white rounded-xl p-6 border border-gray-200">
                <div class="mb-4">
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Statistik</p>
                    <h5 class="leading-none text-xl font-bold text-gray-900 dark:text-white pb-2">Kepuasan Rekomendasi
                    </h5>
                </div>
                @php
                    $total_kepuasan = $tidak_puas + $puas + $sangat_puas;
                    $persen_tidak_puas = $total_kepuasan > 0 ? ($tidak_puas / $total_kepuasan) * 100 : 0;
                    $persen_puas = $total_kepuasan > 0 ? ($puas / $total_kepuasan) * 100 : 0;
                    $persen_sangat_puas = $total_kepuasan > 0 ? ($sangat_puas / $total_kepuasan) * 100 : 0;
                @endphp
              <div class="h-6 w-full rounded-lg bg-gray-200 mb-6 flex overflow-hidden">
    <span class="bg-rose-400" style="width: {{ $persen_tidak_puas }}%"></span>
    <span class="bg-yellow-300" style="width: {{ $persen_puas }}%"></span>
    <span class="bg-green-400" style="width: {{ $persen_sangat_puas }}%"></span>
</div>
                <div class="flex justify-between text-sm text-gray-500">
                    <div class="flex flex-col items-center text-center">
                        <span class="text-xs">Tidak Puas</span>
                        <div class="flex items-center">
                            <span class="text-rose-400 text-lg mr-2">😞</span>
                            <span class="text-gray-900 font-semibold text-base">{{$tidak_puas}}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <span class="text-xs">Puas</span>
                        <div class="flex items-center">
                            <span class="text-yellow-400 text-lg mr-2">😐</span>
                            <span class="text-gray-900 font-semibold text-base">{{$puas}}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <span class="text-xs">Sangat Puas</span>
                        <div class="flex items-center">
                            <span class="text-green-400 text-lg mr-2">😊</span>
                            <span class="text-gray-900 font-semibold text-base">{{$sangat_puas}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const chartData = {
            series: @json($skillCounts),
            labels: @json($skillLabels),
            colors: ["#1E40AF", "#2563EB", "#60A5FA", "#BFDBFE", "#93C5FD", "#DBEAFE"], // Tambahkan warna sesuai jumlah data
        };
    
        const getChartOptions = () => {
            return {
                series: chartData.series,
                colors: chartData.colors,
                chart: {
                    height: 250,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["#ffffff"],
                },
                plotOptions: {
                    pie: {
                        size: "100%",
                        dataLabels: {
                            offset: -25,
                        },
                    },
                },
                labels: chartData.labels,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        fontSize: '14px',
                    },
                },
                legend: {
                    show: false, // Disable built-in legend
                },
            };
        };
    
        // Render custom legend dynamically
        const renderCustomLegend = () => {
            const legendContainer = document.getElementById("custom-legend");
            legendContainer.innerHTML = "";
    
            chartData.labels.forEach((label, index) => {
                const color = chartData.colors[index % chartData.colors.length];
                const value = chartData.series[index];
    
                const item = document.createElement("li");
                item.className = "flex items-center gap-2";
                item.innerHTML = `
                    <span class="w-3 h-3 rounded-full" style="background-color: ${color};"></span>
                    ${label}
                `;
                legendContainer.appendChild(item);
            });
        };
    
        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            chart.render();
            renderCustomLegend();
        }
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chartContainer = document.getElementById("labels-chart");
            if (!chartContainer || typeof ApexCharts === 'undefined') {
                console.warn("Chart container not found or ApexCharts not loaded");
                return;
            }

            const selectedYear = @json($selectedYear);
            let options;

            if (selectedYear) {
                // Tampilkan data bulanan
                options = {
                    chart: {
                        height: '320',
                        type: 'area',
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        name: `Diterima Bulan Tahun ${selectedYear}`,
                        data: @json($monthlyData),
                        color: '#2563eb'
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt',
                            'Nov', 'Des'
                        ],
                        labels: {
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        }
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
                    fill: {
                        type: 'gradient',
                        gradient: {
                            opacityFrom: 0.55,
                            opacityTo: 0,
                            shade: "#2563eb",
                            gradientToColors: ["#2563eb"]
                        }
                    },
                    tooltip: {
                        enabled: true
                    },
                    grid: {
                        show: false
                    },
                    legend: {
                        show: false
                    }
                };
            } else {
                // Tampilkan data tahunan
                options = {
                    chart: {
                        height: '320',
                        type: 'area',
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        name: "Diterima Per Tahun",
                        data: @json($totals),
                        color: '#2563eb'
                    }],
                    xaxis: {
                        categories: @json($years),
                        labels: {
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        }
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
                    fill: {
                        type: 'gradient',
                        gradient: {
                            opacityFrom: 0.55,
                            opacityTo: 0,
                            shade: "#2563eb",
                            gradientToColors: ["#2563eb"]
                        }
                    },
                    tooltip: {
                        enabled: true
                    },
                    grid: {
                        show: false
                    },
                    legend: {
                        show: false
                    }
                };
            }

            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        });
    </script>
@endsection
