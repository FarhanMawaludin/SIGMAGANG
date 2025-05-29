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
                                {{ $dosen->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="flex flex-col gap-6">
                <!-- Data Pengajuan -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
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

                <!-- Lampiran Dokumen -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Lampiran Dokumen</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $dokumens = [
                                ['label' => 'CV', 'data' => $dokumen_cv],
                                ['label' => 'Transkrip Nilai', 'data' => $dokumen_transkrip],
                                ['label' => 'Surat Pengantar', 'data' => $dokumen_pengantar],
                                ['label' => 'Sertifikat Magang', 'data' => $dokumen_surat_keterangan_magang],
                            ];
                        @endphp

                        @foreach ($dokumens as $dok)
                            <div class="flex flex-col gap-2">
                                <p class="text-[16px] text-gray-500 mb-1">File {{ $dok['label'] }}</p>
                                @if ($dok['data'])
                                    <a href="{{ asset('storage/' . $dok['data']->file_path) }}" target="_blank"
                                        class="inline-flex items-center gap-2 bg-gray-100 border border-gray-300 rounded-lg pl-3 pr-36 py-2.5 text-gray-600 text-sm hover:bg-gray-200">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                                            </svg>
                                            <span class="text-[16px] text-gray-900">Lihat File</span>
                                        </div>
                                    </a>
                                @else
                                    <span class="text-gray-400">Belum ada file</span>
                                @endif
                            </div>
                        @endforeach

                        <!-- File Sertifikat -->
                        <div>
                            <p class="text-[16px] text-gray-500 mb-1">File Sertifikat</p>
                            @if ($dokumen_sertifikat && count($dokumen_sertifikat))
                                <div class="flex flex-col gap-2">
                                    @foreach ($dokumen_sertifikat as $d)
                                        <a href="{{ asset('storage/' . $d->file_path) }}" target="_blank"
                                            class="inline-flex items-center gap-2 bg-gray-100 border border-gray-300 rounded-lg pl-3 pr-36 py-2.5 text-gray-600 text-sm hover:bg-gray-200">
                                            <div class="flex items-center gap-3">
                                                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                                                </svg>
                                                <span class="text-[16px] text-gray-900">Lihat Sertifikat</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">Belum ada file</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catatan Validasi -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 mb-[80px]">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Catatan Validasi</h2>
            <textarea name="catatan_validasi" rows="4" class="w-full p-2 border border-gray-300 rounded text-gray-700">{{ old('catatan_validasi', $pengajuan->catatan_validasi) }}</textarea>
            @if ($errors->has('catatan_validasi'))
                <span class="text-red-500 text-sm">{{ $errors->first('catatan_validasi') }}</span>
            @endif
        </div>

        <!-- Tombol Aksi -->
        <div class="fixed bottom-0 right-0 w-full bg-white border-t border-gray-200 px-6 py-4 flex justify-between gap-2">
            <a href="{{ route('admin.pengajuan.index') }}"
                class="ml-[250px] inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded px-4 py-2">Kembali</a>
            @if ($pengajuan->status == 'accepted')
                <button name="action" value="done" type="submit"
                    onclick="return confirm('Apakah Anda yakin ingin menyelesaikan magang ini?')"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold rounded px-4 py-2">Selesai</button>
            @elseif ($pengajuan->status == 'pending' || $pengajuan->status == 'rejected')
                <div class="flex gap-2">
                    <button name="action" value="accept" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menerima pengajuan ini?')"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold rounded px-4 py-2"
                        {{ $pengajuan->status == 'accepted' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>Accept</button>
                    <button name="action" value="decline" type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded px-4 py-2"
                        {{ $pengajuan->status == 'rejected' ? 'disabled opacity-50 cursor-not-allowed' : '' }}>Decline</button>
                </div>
            @endif
        </div>
    </form>
@endsection
