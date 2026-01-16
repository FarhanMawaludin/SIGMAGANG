@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.periode.store') }}">
        @csrf
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Tambah Pengguna</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- deskripsi -->
                    <div class="col-span-4">
                        <label for="deskripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi</label>
                        <div class="mt-2">
                            <input type="text" name="deskripsi" id="deskripsi" autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tanggal Lahir (Date Picker 1) -->
                    <div class="col-span-1">
                        <label for="tanggal_mulai" class="block text-sm/6 font-medium text-gray-900">Tanggal Mulai</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('tanggal_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tanggal Masuk (Date Picker 2) -->
                    <div class="col-span-1">
                        <label for="tanggal_selesai" class="block text-sm/6 font-medium text-gray-900">Tanggal Masuk</label>
                        <div class="mt-2">
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('tanggal_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2 flex items-center justify-start gap-x-6 sm:col-span-full">
                        <button type="button"
                            class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2" onclick="location.href='{{ route('admin.periode.index') }}'">Batal</button>
                        <button type="submit"
                            class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                    </div>
                </div>
            </div>
    </form>
@endsection
