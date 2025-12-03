@extends('layouts.mahasiswa-app')

@section('content')
    <form method="POST" action="{{ route('mahasiswa.profil.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Edit Profil Mahasiswa</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                {{-- Nama Lengkap --}}
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Nama Lengkap</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <label for="name" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"> --}}
                </div>

                {{-- NIM --}}
                <div class="sm:col-span-3">
                    <label for="nim" class="block text-sm/6 font-medium text-gray-900">NIM</label>
                    <div class="mt-2">
                        <input type="text" name="nim" id="nim" value="{{ $user->mahasiswa?->nim ?? '' }}"
                            autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('nim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <label class="block text-sm font-medium text-gray-900">NIM</label>
                    <input type="text" value="{{ $user->mahasiswa->nim }}"
                        class="mt-2 block w-full bg-gray-100 px-3 py-1.5 rounded-md border border-gray-300 text-gray-700 sm:text-sm"> --}}
                </div>

                {{-- Email --}}
                <div class="sm:col-span-3">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"> --}}
                </div>

                {{-- No Telepon --}}
                <div class="sm:col-span-3">
                    <label for="no_telp" class="block text-sm/6 font-medium text-gray-900">No Telepon</label>
                    <div class="mt-2">
                        <input type="text" name="no_telp" id="no_telp"
                            value="{{ old('no_telp', $user->mahasiswa->no_telp ?? '') }}" autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('no_telp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <label for="no_telp" class="block text-sm font-medium text-gray-900">No Telepon</label>
                    <input type="text" name="no_telp" id="no_telp"
                        value="{{ old('no_telp', $user->mahasiswa->no_telp) }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"> --}}
                </div>

                {{-- Prodi --}}
                {{-- <div class="sm:col-span-3"> --}}
                <div class="sm:col-span-3">
                    <label for="prodi_id" class="block text-sm/6 font-medium text-gray-900">Prodi</label>
                    <select name="prodi_id" id="prodi_id"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @foreach ($prodis ?? [] as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <label for="nama" class="block text-sm/6 font-medium text-gray-900">Program Studi</label>
                    <div class="mt-2">
                        <input type="text" name="nama" id="nama" value="{{ $user->mahasiswa->prodi->nama }}"
                            autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> --}}
                {{-- <label class="block text-sm font-medium text-gray-900">Program Studi</label>
                    <input type="text" value="{{ $user->mahasiswa->prodi->nama }}" readonly
                        class="mt-2 block w-full bg-gray-100 px-3 py-1.5 rounded-md border border-gray-300 text-gray-700 sm:text-sm"> --}}
                {{-- </div> --}}

                {{-- Semester --}}
                <div class="sm:col-span-3">
                    <label for="semester" class="block text-sm/6 font-medium text-gray-900">Semester</label>
                    <div class="mt-2">
                        <input type="text" name="semester" id="semester"
                            value="{{ old('semester', $user->mahasiswa->semester ?? '') }}" autocomplete="given-name"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('semester')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <label for="semester" class="block text-sm font-medium text-gray-900">Semester</label>
                    <input type="text" name="semester" id="semester"
                        value="{{ old('semester', $user->mahasiswa->semester) }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm"> --}}
                </div>

                {{-- Foto Upload --}}
                <div class="col-span-full">
                    <label for="foto" class="block text-sm font-medium text-gray-900">Upload Foto Profil</label>
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <p class="mt-1 text-sm text-gray-500">JPG, PNG, atau GIF. Max 800x400px.</p>
                     @if ($errors->has('foto'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('foto') }}</p>
                     @endif
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <a href="{{ route('mahasiswa.profil.index') }}"
                    class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan
                    Perubahan</button>
            </div>
        </div>
    </form>
@endsection
