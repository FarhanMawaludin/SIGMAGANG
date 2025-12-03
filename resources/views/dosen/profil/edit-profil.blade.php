@extends('layouts.dosen-app')

@section('content')
    <form method="POST" action="{{ route('dosen.profil.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Edit Profil Dosen</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                {{-- Nama Lengkap --}}
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Nama Lengkap</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- NIDN --}}
                <div class="sm:col-span-3">
                    <label for="nidn" class="block text-sm/6 font-medium text-gray-900">NIDN</label>
                    <div class="mt-2">
                        <input type="text" id="nidn" name="nidn" value="{{ $user->dosenPembimbing->nidn ?? '' }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('nidn')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="sm:col-span-3">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- No Telepon --}}
                <div class="sm:col-span-3">
                    <label for="no_telp" class="block text-sm/6 font-medium text-gray-900">No Telepon</label>
                    <div class="mt-2">
                        <input type="text" name="no_telp" id="no_telp"
                            value="{{ old('no_telp', $user->dosenPembimbing->no_telp ?? '') }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('no_telp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="jabatan" class="block text-sm font-medium text-gray-900">Jabatan</label>
                    <select name="jabatan" id="jabatan"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="lektor" {{ old('jabatan', $dosen->jabatan ?? '') === 'lektor' ? 'selected' : '' }}>
                            Lektor</option>
                        <option value="asisten_ahli"
                            {{ old('jabatan', $dosen->jabatan ?? '') === 'asisten_ahli' ? 'selected' : '' }}>Asisten Ahli
                        </option>
                    </select>

                    @error('jabatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jabatan --}}
                {{-- <div class="sm:col-span-3">
                    <label for="jabatan" class="block text-sm/6 font-medium text-gray-900">Jabatan</label>
                    <div class="mt-2">
                        <input type="text" name="jabatan" id="jabatan"
                            value="{{ old('jabatan', $user->dosenPembimbing->jabatan ?? '') }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div> --}}

                {{-- Prodi --}}
                <div class="sm:col-span-3">
                    <label for="prodi_id" class="block text-sm/6 font-medium text-gray-900">Prodi</label>
                    <select name="prodi_id" id="prodi_id"
                        class="mt-1 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @foreach ($prodis ?? [] as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Foto --}}
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
                <a href="{{ route('dosen.profil.index') }}"
                    class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan
                    Perubahan</button>
            </div>
        </div>
    </form>
@endsection
