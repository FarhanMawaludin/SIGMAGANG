@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Log Aktivitas</h1>
    </div>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            {{-- @if ($userItem->foto)
                                    <img src="{{ asset('images/logo/' . $userItem->foto) }}"
                                        alt="Foto {{ $userItem->name }}"
                                        class="w-10 h-10 rounded-full object-cover shrink-0">
                                @else
                                    <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                                        class="w-10 h-10 rounded-full border border-gray-200 object-cover shrink-0">
                                @endif
                                <div class="min-w-0">
                                    <div class="font-medium md:text-base break-words truncate md:whitespace-normal">
                                        {{ $userItem->name }}
                                    </div>
                                </div> --}}
                            Farhan Mawaludin
                        </div>
                    </td>
                    {{-- <td class="px-6 py-4">{{ ucwords(str_replace('_', ' ', $userItem->role)) }}</td> --}}
                    <td class="px-6 py-4">2023-08-01</td>
                    {{-- <td class="px-6 py-4">{{ $userItem->email }}</td> --}}
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-600">
                            Aktif
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        <!-- Detail -->
                        <button
                            class="inline-flex items-center bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm cursor-pointer"
                            onclick="location.href='{{ route('mahasiswa.monitoring.create') }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d=" M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span class="hidden md:inline">Unggah Log</span>
                        </button>
                    </td>
                </tr>
                {{-- @empty --}}
                    {{-- <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr> --}}
                    {{-- @endforelse --}}
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="p-4">
                {{-- {{ $user->links('pagination::tailwind') }} --}}
            </div>
        @endsection
