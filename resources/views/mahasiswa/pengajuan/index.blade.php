@extends('layouts.mahasiswa-app')

@section('content')
@php
    $category = $category ?? 'all';
@endphp

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-800">Lowongan Magang</h1>
</div>

<div class="flex justify-between items-center mb-4">
    <form class="flex w-full max-w-lg" method="GET" action="{{ route('mahasiswa.pengajuan.index') }}">
        <div class="flex w-full relative">
            <!-- Hidden input untuk menyimpan kategori -->
            <input type="hidden" name="category" id="selected-category" value="{{ $category }}">

            <!-- Tombol dropdown -->
            <button id="dropdown-button" type="button"
                class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
                {{ $category === 'all' ? 'Semua Status' : ucfirst($category) }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-20 hidden absolute top-12 left-0 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                    <li><button type="button" data-value="all"
                            class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua Status</button></li>
                    <li><button type="button" data-value="pending"
                            class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pending</button></li>
                    <li><button type="button" data-value="accepted"
                            class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Accepted</button></li>
                    <li><button type="button" data-value="rejected"
                            class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Rejected</button></li>
                    <li><button type="button" data-value="completed"
                            class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Completed</button></li>
                </ul>
            </div>

            <!-- Search input -->
            <div class="relative w-full">
                <input type="search" id="search-dropdown" name="search"
                    class="block p-2.5 w-full z-10 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                    placeholder="Cari..." value="{{ $search ?? '' }}" />
                <button type="submit"
                    class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>
</div>

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
                    <div class="font-medium text-gray-900">{{ $item->mahasiswa->user->name ?? '-' }}</div>
                    <div class="text-xs text-gray-500">{{ $item->mahasiswa->nim ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">{{ $item->lowongan->nama ?? '-' }}</td>
                <td class="px-6 py-4">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                        {{ 
                            $item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            ($item->status === 'accepted' ? 'bg-green-100 text-green-800' :
                            ($item->status === 'rejected' ? 'bg-red-100 text-red-800' :
                            ($item->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')))
                        }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.pengajuan.edit', $item->id) }}"
                        class="inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                        Lihat
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Data tidak tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
    <!-- Pagination -->
    <div class="p-4">
        {{ $pengajuan->links('pagination::tailwind') }}
    </div>
    </div>

    <!-- JavaScript -->
    <script>
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown');
        const categoryButtons = document.querySelectorAll('.category-btn');
        const selectedCategoryInput = document.getElementById('selected-category');

        // Toggle dropdown
        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Handle category selection and submit form
        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedValue = button.getAttribute('data-value');
                const displayText = button.textContent.trim();

                selectedCategoryInput.value = selectedValue;
                dropdownButton.innerHTML = `${displayText}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>`;

                dropdownMenu.classList.add('hidden');

                // Automatically submit the form when a category is selected
                button.closest('form').submit();
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
@endsection