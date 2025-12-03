@extends('layouts.dosen-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pengguna</h1>
    </div>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200 bg-white">
        {{-- Foto Profil --}}
        <div class="flex justify-center py-6">
            @if ($pengajuan->mahasiswa->user && $pengajuan->mahasiswa->user->foto)
                <img src="{{ asset('storage/' . $pengajuan->mahasiswa->user->foto) }}" alt="Foto Profil"
                    class="w-24 h-24 rounded-full object-cover border border-gray-300">
            @else
                <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                    class="w-24 h-24 rounded-full object-cover border border-gray-300">
            @endif
            {{-- <img src="{{ asset('storage/foto/' . $pengajuan->foto) }}" alt="Foto {{ $pengajuan->name }}"
                class="w-32 h-32 rounded-full object-cover border border-gray-300"> --}}
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
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->user->name }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Email</td>
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->user->email }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Program Studi</td>
                    <td class="px-6 py-4">{{ $pengajuan->mahasiswa->prodi->nama }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Lowongan</td>
                    <td class="px-6 py-4">{{ $pengajuan->lowongan->nama }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Perusahaan</td>
                    <td class="px-6 py-4">{{ $pengajuan->lowongan->perusahaan->nama }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Tipe Magang</td>
                    <td class="px-6 py-4">{{ $pengajuan->lowongan->tipe_magang }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Periode</td>
                    <td class="px-6 py-4">{{ $pengajuan->lowongan->periode->deskripsi }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Role</td>
                    <td class="px-6 py-4">
                        <span
                            class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                            {{ $pengajuan->role === 'admin'
                                ? 'bg-indigo-100 text-indigo-600'
                                : ($pengajuan->role === 'dosen_pembimbing'
                                    ? 'bg-green-100 text-green-600'
                                    : 'bg-yellow-100 text-yellow-600') }}">
                            {{ ucfirst(str_replace('_', ' ', $pengajuan->mahasiswa->user->role)) }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Tombol Kembali --}}
        <div class="text-center py-6">
            <a href="{{ route('dosen.mahasiswa.index') }}"
                class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm">
                <!-- Ikon Panah Kiri -->
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>

                Kembali ke Daftar Bimbingan
            </a>
        </div>
    </div>
@endsection
