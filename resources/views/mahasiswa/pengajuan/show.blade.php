{{-- filepath: c:\coolyeah\SEM4\SIGMAGANG-NEW\resources\views\mahasiswa\pengajuan\show.blade.php --}}
@extends('layouts.mahasiswa-app')

@section('title', 'Detail Pengajuan')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan Magang</h1>
    </div>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200 bg-white">
        {{-- Foto Profil --}}
        <div class="flex justify-center py-6">
            @if ($pengajuan->mahasiswa->user->photo ?? false)
                <img src="{{ asset('images/logo/' . $pengajuan->mahasiswa->user->photo) }}"
                    alt="Foto {{ $pengajuan->mahasiswa->user->name }}" class="w-32 h-32 rounded-full object-cover shrink-0">
            @else
                <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                    class="w-32 h-32 rounded-full border border-gray-200 object-cover shrink-0">
            @endif
        </div>

        {{-- Tabel Informasi --}}
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 w-1/3">Informasi</th>
                    <th scope="col" class="px-6 py-3">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Nama</td>
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->user->name ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Email</td>
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->user->email ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">NIM</td>
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->nim ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Program Studi</td>
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->prodi->nama ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Perusahaan</td>
                    <td class="px-6 py-4">{{ $pengajuan->lowongan->perusahaan->nama ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Lowongan</td>
                    <td class="px-6 py-4">{{ $pengajuan->lowongan->nama ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Status Pengajuan</td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-orange-100 text-orange-600',
                                'accepted' => 'bg-green-100 text-green-600',
                                'rejected' => 'bg-red-100 text-red-600',
                            ];
                            $statusText = [
                                'pending' => 'Menunggu',
                                'accepted' => 'Diterima',
                                'rejected' => 'Ditolak',
                            ];
                            $status = strtolower($pengajuan->status);
                        @endphp
                        <span
                            class="{{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-600' }} text-xs font-medium px-3 py-1 rounded-full">
                            {{ $statusText[$status] ?? ucfirst($pengajuan->status) }}
                        </span>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Dosen Pembimbing</td>
                    <td class="px-6 py-4">{{ $pengajuan->dosen->user->name ?? '-' }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Tanggal Pengajuan</td>
                    <td class="px-6 py-4">
                        {{ $pengajuan->created_at ? $pengajuan->created_at->format('d M Y') : '-' }}
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-bold text-red-600">Catatan</td>
                    <td class="px-6 py-4 text-red-600">{{ $pengajuan->catatan_validasi }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Tombol Kembali --}}
        <div class="text-center py-6">
            <a href="{{ route('mahasiswa.pengajuan.index') }}"
                class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Pengajuan
            </a>
        </div>
    </div>
@endsection
