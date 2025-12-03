@extends('layouts.mahasiswa-app')

@section('content')
    <div class=" mt-24 text-center">
        <!-- Header -->
        <h1 class="text-2xl sm:text-3xl font-semibold mb-2">
            Selamat Datang,
            <span class="text-blue-600 font-bold hover:underline cursor-pointer">{{ auth()->user()->name }}</span> 👋
        </h1>
        <p class="text-gray-500 mb-6 text-sm sm:text-base">
            Lengkapi profilmu sekarang untuk melihat magang yang paling cocok buat kamu.
        </p>

        <!-- Button Group -->
        <div class="flex justify-center gap-4 mb-18">
            <button class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 cursor-pointer" onclick="location.href='{{ route('mahasiswa.profil.index') }}'">
                Lengkapi Profile
            </button>
            <button class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 cursor-pointer" onclick="location.href='{{ route('mahasiswa.lowongan.index') }}'">
                Lihat Rekomendasi
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto relative rounded-lg border border-gray-200">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Lowongan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuan as $key => $item)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $pengajuan->firstItem() + $key }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium md:text-base break-words truncate md:whitespace-normal">
                                    {{ $item->mahasiswa->user->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 ">{{ $item->lowongan->nama ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                {{ $item->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : ($item->status === 'accepted'
                                        ? 'bg-green-100 text-green-800'
                                        : ($item->status === 'rejected'
                                            ? 'bg-red-100 text-red-800'
                                            : ($item->status === 'completed'
                                                ? 'bg-blue-100 text-blue-800'
                                                : 'bg-gray-100 text-gray-800'))) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('mahasiswa.pengajuan.show', $item->id) }}"
                                    class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pengajuan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="p-4">
                {{-- {{ $user->links('pagination::tailwind') }} --}}
            </div>
        </div>
    </div>
@endsection
