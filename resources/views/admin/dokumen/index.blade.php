@extends('layouts.app')

@section('content')
    @php
        // Assuming $category and $search might come from the request or be default
        $category = request('category', 'all');
        $search = request('search', '');
    @endphp

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">All Documents (Admin View)</h1>
    </div>

    <div class="flex justify-between items-center mb-4">
        <form class="flex w-full max-w-lg" method="GET" action="{{ route('admin.dokumen.index') }}">
            <div class="flex w-full relative">
                <input type="hidden" name="category" id="selected-category" value="{{ $category }}">

                <button id="dropdown-button" type="button"
                    class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
                    {{ $category === 'all' ? 'Semua Tipe' : ucfirst($category) }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div id="dropdown"
                    class="z-20 hidden absolute top-12 left-0 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li><button type="button" data-value="all"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua
                                Tipe</button></li>
                        <li><button type="button" data-value="CV"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">CV</button>
                        </li>
                        <li><button type="button" data-value="Sertifikat"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sertifikat</button>
                        </li>
                        <li><button type="button" data-value="Surat Pengantar"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Surat Pengantar</button>
                        </li>
                        <li><button type="button" data-value="Transkrip Nilai"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Transkrip Nilai</button>
                        </li>
                    </ul>
                </div>

                <div class="relative w-full">
                    <input type="search" id="search-dropdown" name="search"
                        class="block p-2.5 w-full z-10 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Cari..." value="{{ $search }}" />
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
        {{-- Admin-specific: Add Document button --}}
        <a href="{{ route('admin.dokumen.create') }}" class="inline-flex items-center bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition cursor-pointer ml-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>Add Document</span>
        </a>
    </div>

    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Document Type</th>
                    <th class="px-6 py-3">File Name</th>
                    <th class="px-6 py-3">Owner</th> {{-- Admin-specific column --}}
                    <th class="px-6 py-3"></th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokumens as $key => $dokumen)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $dokumen->tipe }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ basename($dokumen->file_path) }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $dokumen->documentable_type }} (ID: {{ $dokumen->dcoumentable_id }})</td> {{-- Admin-specific data --}}
                        <td class="px-6 py-4">
                        </td>
                        <td class="px-6 py-4 text-center flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 justify-center">
                            <button
                                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer"
                                onclick="location.href='{{ route('admin.dokumen.show', $dokumen->id) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="hidden md:inline">Detail</span>
                            </button>
                            <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="inline-flex items-center bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span class="hidden md:inline">Edit</span>
                            </a>
                            <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1H9a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="hidden md:inline">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No documents found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{-- Assuming $dokumens is paginated --}}
        {{-- {{ $dokumens->links('pagination::tailwind') }} --}}
        <nav class="mt-6 flex justify-end">
            <ul class="pagination flex space-x-1">
                <li class="page-item disabled">
                    <a class="page-link py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300" href="#">1</a></li>
                <li class="page-item"><a class="page-link py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300" href="#">2</a></li>
                <li class="page-item"><a class="page-link py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

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
