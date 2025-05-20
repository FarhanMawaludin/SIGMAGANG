@extends('layouts.mahasiswa-app')

@section('content')
    <form method="POST" action="{{ route('mahasiswa.monitoring.store') }}">
        @csrf
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Form Log Mingguan</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">

                    <!-- Tanggal Awal Mingguan -->
                    <div class="sm:col-span-2">
                        <label for="tanggal_awal" class="block text-sm font-medium text-gray-900">Tanggal Awal</label>
                        <div class="mt-2">
                            <input type="date" id="tanggal_awal" name="tanggal_awal"
                                @if($nextMinggu != 1) readonly @endif
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                min="{{ $minTanggalAwal }}"
                                value="{{ old('tanggal_awal', $minTanggalAwal) }}">
                            @error('tanggal_awal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tanggal Akhir Mingguan -->
                    <div class="sm:col-span-2">
                        <label for="tanggal_akhir" class="block text-sm font-medium text-gray-900">Tanggal Akhir</label>
                        <div class="mt-2">
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir"
                                @if($nextMinggu != 1) readonly @endif
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                min="{{ $maxTanggalAkhir }}"
                                value="{{ old('tanggal_akhir', $maxTanggalAkhir) }}">
                            @error('tanggal_akhir')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Minggu Ke -->
                    <div class="sm:col-span-1">
                        <label for="minggu" class="block text-sm font-medium text-gray-900">Minggu Ke</label>
                        <div class="mt-2">
                            <input type="number" id="minggu" name="minggu" min="{{ $nextMinggu }}" readonly
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Minggu Ke" value="{{ old('minggu',$nextMinggu) }}">
                            @error('minggu')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Tombol Aksi -->
                    <div class="col-span-full mt-4 flex items-center justify-start gap-x-6">
                        <button type="button"
                            class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2"
                            onclick="location.href='{{ route('mahasiswa.monitoring.index') }}'">Batal</button>
                        <button type="submit"
                            class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection