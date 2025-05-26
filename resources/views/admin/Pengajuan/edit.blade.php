@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Pengajuan Magang</h1>
    <form action="{{ route('admin.pengajuan.update', $pengajuan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4">

            <!-- Kolom Kiri -->
            <div class="flex flex-col gap-6">

                <!-- Data Mahasiswa -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Data Mahasiswa</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-800">Nama</h4>
                            <p class="text-gray-600">{{ $pengajuan->mahasiswa->user->name }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">NIM</h4>
                            <p class="text-gray-600">{{ $pengajuan->mahasiswa->nim }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Prodi</h4>
                            <p class="text-gray-600">{{ $pengajuan->mahasiswa->prodi->nama }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Semester</h4>
                            <p class="text-gray-600">{{ $pengajuan->mahasiswa->semester }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Email</h4>
                            <p class="text-gray-600">{{ $pengajuan->mahasiswa->user->email }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">No Telepon</h4>
                            <p class="text-gray-600">{{ $pengajuan->mahasiswa->no_telp }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dosen Pembimbing -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Dosen Pembimbing</h2>
                    <select class="w-full p-2 border border-gray-300 rounded mb-4 text-gray-700" name="dosen_id">
                        <option value="">Pilih Dosen Pembimbing</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id }}" {{ $pengajuan->dosen_id == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="flex flex-col gap-6">
                <!-- Data Pengajuan -->
                <div class="bg-white p-6 rounded-lg border border-gray-200 ">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Data Pengajuan</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-semibold text-gray-800">Nama Perusahaan</h4>
                            <p class="text-gray-600">{{ $pengajuan->lowongan->perusahaan->nama }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Posisi</h4>
                            <p class="text-gray-600">{{ $pengajuan->lowongan->nama }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Jenis Magang</h4>
                            <p class="text-gray-600">{{ $pengajuan->lowongan->jenisMagang->jenis_magang }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Posisi Tersedia</h4>
                            <p class="text-gray-600">{{ $pengajuan->lowongan->jumlah_magang }} Pelamar</p>
                        </div>
                    </div>
                </div>

                <!-- Lampiran -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Lampiran</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- File CV -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">File CV</h4>
                            @if ($dokumen_cv)
                                <a href="{{ asset('storage/' . $dokumen_cv->file_path) }}" target="_blank" class="flex items-center border rounded p-2 gap-3 hover:bg-gray-50">
                                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="pdf" class="w-6 h-6">
                                    <span class="text-blue-700 underline">Lihat CV</span>
                                </a>
                            @else
                                <span class="text-gray-500">Tidak ada file</span>
                            @endif
                        </div>

                        <!-- Transkrip -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">File Transkrip Nilai</h4>
                            @if ($dokumen_transkrip)
                                <a href="{{ asset('storage/' . $dokumen_transkrip->file_path) }}" target="_blank" class="flex items-center border rounded p-2 gap-3 hover:bg-gray-50">
                                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="pdf" class="w-6 h-6">
                                    <span class="text-blue-700 underline">Lihat Transkrip</span>
                                </a>
                            @else
                                <span class="text-gray-500">Tidak ada file</span>
                            @endif
                        </div>

                        <!-- Sertifikat -->
                        @foreach ($dokumen_sertifikat as $d )
                            
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">File Sertifikat</h4>
                            @if ($d)
                                <a href="{{ asset('storage/' . $d->file_path) }}" target="_blank" class="flex items-center border rounded p-2 gap-3 hover:bg-gray-50">
                                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="pdf" class="w-6 h-6">
                                    <span class="text-blue-700 underline">Lihat Sertifikat</span>
                                </a>
                            @else
                                <span class="text-gray-500">Tidak ada file</span>
                            @endif
                        </div>
                        @endforeach

                        <!-- Surat Pengantar -->
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">File Surat Pengantar</h4>
                            @if ($dokumen_pengantar)
                                <a href="{{ asset('storage/' . $dokumen_pengantar->file_path) }}" target="_blank" class="flex items-center border rounded p-2 gap-3 hover:bg-gray-50">
                                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="pdf" class="w-6 h-6">
                                    <span class="text-blue-700 underline">Lihat Surat Pengantar</span>
                                </a>
                            @else
                                <span class="text-gray-500">Tidak ada file</span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- Catatan_validasi -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Catatan Validasi</h2>
            <textarea name="catatan_validasi" rows="4"
                class="w-full p-2 border border-gray-300 rounded text-gray-700">{{ old('catatan_validasi', $pengajuan->catatan_validasi) }}</textarea>
            @if ($errors->has('catatan_validasi'))
                <span class="text-red-500 text-sm">{{ $errors->first('catatan_validasi') }}</span>
            @endif
        </div>

        {{-- Tombol --}}
        <div class="fixed bottom-0 right-0 w-full bg-white border-t border-gray-200 px-6 py-4 flex justify-between gap-2">
            <a href="{{ route('admin.pengajuan.index') }}"
                class="ml-[250px] inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded px-4 py-2">
                Kembali
            </a>
            @if ($pengajuan->status == 'accepted' || $pengajuan->status == 'rejected')
                <div class="flex gap-2">
                    <button name="action" value="accept" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menerima pengajuan ini?')"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold rounded px-4 py-2" disabled
                        {{ $pengajuan->status == 'accepted' ? 'opacity-50 cursor-not-allowed' : '' }}>
                        Accept
                    </button>
                    <button name="action" value="decline" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded px-4 py-2" disabled
                        {{ $pengajuan->status == 'rejected' ? 'opacity-50 cursor-not-allowed' : '' }}>
                        Decline
                    </button>
                </div>
            @else
                <div class="flex gap-2">
                    <button name="action" value="accept" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menerima pengajuan ini?')"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold rounded px-4 py-2"
                        {{ $pengajuan->status == 'accepted' ? ' opacity-50 cursor-not-allowed' : '' }}>
                        Accept
                    </button>
                    <button name="action" value="decline" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded px-4 py-2"
                        {{ $pengajuan->status == 'rejected' ? ' opacity-50 cursor-not-allowed' : '' }}>
                        Decline
                    </button>
                </div>
            @endif
        </div>
    </form>
@endsection
