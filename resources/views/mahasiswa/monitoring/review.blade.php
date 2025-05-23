@extends('layouts.mahasiswa-app')

@section('content')
    <form method="POST" action="{{ route('mahasiswa.monitoring.review.update') }}">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Form Review Magang</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                    <!-- Review -->
                    <div class="sm:col-span-full">
                        <label for="mahasiswa_feedback" class="block text-sm font-medium text-gray-900">Tulis Review Magang Anda</label>
                        <div class="mt-2">
                            <textarea id="mahasiswa_feedback" name="mahasiswa_feedback" rows="5"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Tulis review di sini...">{{ old('mahasiswa_feedback', $pengajuan->mahasiswa_feedback ?? '') }}</textarea>
                            @error('mahasiswa_feedback')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Tombol Aksi -->
                    <div class="col-span-full mt-6 flex flex-col sm:flex-row items-center justify-end gap-3">
    <button type="button"
        class="px-4 py-2 text-sm font-semibold text-gray-900 bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 hover:border-gray-400 transition"
        onclick="location.href='{{ route('mahasiswa.monitoring.index') }}'">Batal</button>
    <button type="submit"
        class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">Kirim</button>
</div>
                </div>
            </div>
        </div>
    </form>
@endsection