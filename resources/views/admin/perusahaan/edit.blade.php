@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.perusahaan.update', $perusahaan->id) }}" enctype="multipart/form-data"
        class="space-y-4">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Edit Perusahaan</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    {{-- Nama --}}
                    <div class="sm:col-span-3">
                        <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama Perusahaan</label>
                        <div class="mt-2">
                            <input type="text" name="nama" id="nama" value="{{ $perusahaan->nama }}" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    {{-- Bidang Perusahaan --}}
                    <div class="sm:col-span-3">
                        <label for="bidang_perusahaan_id" class="block text-sm/6 font-medium text-gray-900">Bidang
                            Perusahaan</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select name="bidang_perusahaan_id" id="bidang_perusahaan_id" required
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="">Pilih Bidang perusahaan</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}"
                                        {{ $perusahaan->bidang_perusahaan_id == $bidang->id ? 'selected' : '' }}>
                                        {{ $bidang->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-span-full">
                        <label for="deskripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi</label>
                        <div class="mt-2">
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $perusahaan->deskripsi }}</textarea>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-span-full">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" required autocomplete="email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                value="{{ $perusahaan->email }}">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-span-full">
                        <label for="alamat" class="block text-sm/6 font-medium text-gray-900">Alamat</label>
                        <div class="mt-2">
                            <input type="text" name="alamat" id="alamat" value="{{ $perusahaan->alamat }}" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    {{-- No Telepon --}}
                    <div class="sm:col-span-3">
                        <label for="no_telp" class="block text-sm/6 font-medium text-gray-900">No Telepon</label>
                        <div class="mt-2">
                            <input type="text" name="no_telp" id="no_telp" value="{{ $perusahaan->no_telp }}" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    {{-- Website --}}
                    <div class="sm:col-span-3">
                        <label for="website" class="block text-sm/6 font-medium text-gray-900">Link Website</label>
                        <div class="mt-2">
                            <input type="text" name="website" id="website" value="{{ $perusahaan->website }}" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    {{-- Foto Upload --}}
                    <div class="col-span-full">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                            file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="foto" name="foto" type="file" accept="image/*">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="foto">SVG, PNG, JPG or GIF
                            (MAX. 800x400px).</p>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <a href="{{ route('admin.perusahaan.index') }}"
                        class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                    <button type="submit"
                        class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection
