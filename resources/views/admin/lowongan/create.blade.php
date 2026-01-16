@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.lowongan.store') }}">
        @csrf
        <div class="space-y-12">
            <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Tambah Lowongan</h2>
            <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama Lowongan</label>
                        <div class="mt-2">
                            <input type="text" name="nama" id="nama"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Masukkan Nama Lowongan">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="nama_perusahaan" class="mb-2 block text-sm/6 font-medium text-gray-900">Nama
                            Perusahaan</label>
                        <select name="perusahaan_id" id="perusahaan_id"
                            class=" block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @foreach ($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="periode_id" class="block text-sm/6 font-medium text-gray-900">Periode</label>
                        <select name="periode_id" id="periode_id"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @foreach ($periodes as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="prodi_id" class="block text-sm/6 font-medium text-gray-900">Prodi</label>
                        <select name="prodi_id" id="prodi_id"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="batas_pendaftaran" class="block text-sm/6 font-medium text-gray-900">Batas
                            Pendaftaran</label>
                        <div class="mt-2">
                            <input type="date" name="batas_pendaftaran" id="batas_pendaftaran"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('batas_pendaftaran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="jumlah_magang" class="block text-sm/6 font-medium text-gray-900">Jumlah Magang</label>
                        <div class="mt-2">
                            <input type="number" name="jumlah_magang" id="jumlah_magang"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('jumlah_magang')
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

                    <div class="col-span-full">
                        <label for="persyaratan" class="block text-sm/6 font-medium text-gray-900">Persyaratan</label>
                        <div class="mt-2">
                            <textarea id="persyaratan" name="persyaratan" rows="5"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Tulis persyaratan"></textarea>
                            @error('persyaratan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label for="lokasi" class="block text-sm/6 font-medium text-gray-900">Lokasi</label>
                        <select name="lokasi" id="lokasi"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">Pilih Lokasi</option>
                            <option value="Malang">Malang</option>
                            <option value="Luar Malang">Luar Malang</option>
                        </select>
                    </div>

                    <div class="col-span-3">
                        <label for="tipe_magang" class="block text-sm/6 font-medium text-gray-900">Tipe Magang</label>
                        <select name="tipe_magang" id="tipe_magang"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">Tipe Magang</option>
                            <option value="onsite">Onsite</option>
                            <option value="remote">Remote</option>
                        </select>
                    </div>

                    <div class="col-span-3">
                        <label for="jenis_magang" class="block text-sm/6 font-medium text-gray-900">Jenis Magang</label>
                        <select name="jenis_magang_id" id="jenis_magang_id"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">Jenis Magang</option>
                            @foreach ($jenismagang as $j)
                                <option value="{{ $j->id }}">{{ $j->jenis_magang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-3">
                        <label for="ipk" class="block text-sm/6 font-medium text-gray-900">IPK</label>
                        <div class="mt-2">
                            <input type="text" name="ipk" id="ipk"
                                autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @error('ipk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="skills" class="block text-sm/6 font-medium text-gray-900">Skills</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-2">
                            @foreach ($skills as $skill)
                                <div class="flex items-center">
                                    <input id="skill-{{ $skill->id }}" name="skills[]" value="{{ $skill->id }}"
                                        type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    <label for="skill-{{ $skill->id }}" class="ml-2 block text-sm text-gray-900">
                                        {{ $skill->nama }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-start gap-x-6">
                        <button type="button"
                            class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2"
                            onclick="location.href='{{ route('admin.lowongan.index') }}'">Batal</button>
                        <button type="submit"
                            class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                    </div>
                </div>
            </div>
    </form>
@endsection
