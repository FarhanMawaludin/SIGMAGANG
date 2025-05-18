@extends('layouts.mahasiswa-app')

@section('content')
    <form method="POST" action="{{ route('admin.lowongan.store') }}">
        @csrf
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Form Log Aktivitas</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                    <!-- Hari/Tanggal -->
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium text-gray-900">Hari/Tanggal</label>
                        <div class="mt-2">
                            <!-- Input disabled untuk ditampilkan -->
                            <input type="text"
                                value="{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                disabled>

                            <!-- Input hidden yang dikirim ke server -->
                            <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <!-- Jam Mulai -->
                    <div class="sm:col-span-1">
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-900">Jam Mulai</label>
                        <div class="mt-2">
                            <input type="text" id="jam_mulai" name="jam_mulai"
                                class="jam-picker block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Pilih Jam Mulai">
                            @error('jam_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="sm:col-span-1">
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-900">Jam Selesai</label>
                        <div class="mt-2">
                            <input type="text" id="jam_selesai" name="jam_selesai"
                                class="jam-picker block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Pilih Jam Selesai">
                            @error('jam_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="col-span-full">
                        <label for="deskripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi</label>
                        <div class="mt-2">
                            <textarea id="deskripsi" name="deskripsi" rows="5"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Tulis Deskripsi"></textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-start gap-x-6">
                        <button type="button"
                            class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2"
                            onclick="location.href='{{ route('mahasiswa.monitoring.index') }}'">Batal</button>
                        <button type="submit"
                            class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                    </div>
                </div>
            </div>
    </form>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr(".jam-picker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 5,
            allowInput: true,
            defaultHour: 8,
            defaultMinute: 0
        });
    </script>
@endsection
