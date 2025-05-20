{{-- filepath: c:\coolyeah\SEM4\SIGMAGANG-NEW\resources\views\mahasiswa\monitoring\create_harian.blade.php --}}
@extends('layouts.mahasiswa-app')

@section('content')
    <form method="POST" action="{{ route('mahasiswa.monitoring.store_harian', $logMingguan->id) }}">
        @csrf
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Form Log Harian</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Tanggal Log Harian -->
                    <div class="sm:col-span-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-900">Tanggal</label>
                        <div class="mt-2">
                            <input type="date" id="tanggal" name="tanggal"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                min="{{ $minTanggalAwal }}" max="{{ $maxTanggalAkhir }}" value="{{ $minTanggalAwal }}">
                            @error('tanggal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Jam Mulai -->
                    <div class="sm:col-span-1">
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-900">Jam Mulai</label>
                        <div class="mt-2">
                            <input type="time" id="jam_mulai" name="jam_mulai"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="sm:col-span-1">
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-900">Jam Selesai</label>
                        <div class="mt-2">
                            <input type="time" id="jam_selesai" name="jam_selesai"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Aktivitas -->
                    <div class="sm:col-span-full">
                        <label for="aktivitas" class="block text-sm font-medium text-gray-900">Aktivitas</label>
                        <div class="mt-2">
                            <textarea id="aktivitas" name="aktivitas" rows="5"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Tulis Aktivitas" value="{{ old('aktivitas') }}"></textarea>
                            {{-- <input type="text" id="aktivitas" name="aktivitas"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Aktivitas harian" value="{{ old('aktivitas') }}">
                            @error('aktivitas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror --}}
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="col-span-full mt-4 flex items-center justify-start gap-x-6">
                        <button type="button"
                            class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2"
                            onclick="location.href='{{ route('mahasiswa.monitoring.show', $logMingguan->id) }}'">Batal</button>
                        <button type="submit"
                            class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
