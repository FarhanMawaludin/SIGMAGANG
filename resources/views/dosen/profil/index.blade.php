@extends('layouts.dosen-app')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Profil Saya</h2>

    <!-- Header Profil dengan Foto -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6 flex items-center gap-6">
        <img src="{{ asset('storage/' .$user->dosen_pembimbing->user->foto) }}" alt="Foto Profil"
            class="w-24 h-24 rounded-full object-cover border border-gray-300">
        <div>
            <h3 class="text-[22px] font-semibold text-gray-900">{{ $user->name }}</h3>
            <p class="text-[18px] text-gray-700">{{ $user->dosen->nip }}</p>
            <p class="text-[18px] text-gray-400">{{ $user->dosen->prodi->nama }}</p>
        </div>
    </div>

    <!-- Informasi Pribadi -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center mb-5">
            <span class="text-lg font-semibold text-gray-800">Informasi Pribadi</span>
            <a href="{{ route('dosen.profil.edit', $user->id) }}"
                class="inline-flex items-center gap-2 border border-yellow-400 text-yellow-500 hover:bg-yellow-50 font-semibold px-5 py-2 rounded-full transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm-6 6h12" />
                </svg>
                Edit
            </a>
        </div>
        <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm text-gray-700">
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Nama Lengkap</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">NIP</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->dosen->nip }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Email</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">No Telepon</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->dosen->no_telp }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Prodi</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->dosen->prodi->nama }}</p>
            </div>
            <div>
                <p class="text-[16px] text-gray-500 mb-1">Jabatan Akademik</p>
                <p class="text-[18px] font-semibold text-gray-900">{{ $user->dosen->jabatan_akademik ?? '-' }}</p>
            </div>
        </div>
    </div>
@endsection
