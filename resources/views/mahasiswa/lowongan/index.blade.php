@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Rekomendasi Lowongan</h1>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @foreach ($lowongan as $item)
            <div class="max-w-sm w-full mx-auto bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('storage/' . $item->perusahaan->foto) }}" alt="KAI Logo" class="h-20">
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
                            class="w-full text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
                            Lihat Detail
                        </button>
                    </a>

                </div>
            </div>
        @endforeach
    </div>
@endsection
