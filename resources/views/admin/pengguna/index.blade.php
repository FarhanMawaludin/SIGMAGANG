@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
    </div>

    <div class="flex justify-between items-center mb-4">
        <form class="flex w-full max-w-lg" method="GET" action="{{ route('admin.pengguna.index') }}">
            <div class="flex w-full">
                <!-- Hidden input to store selected category -->
                <input type="hidden" name="category" id="selected-category" value="{{ $category }}">

                <!-- Dropdown button -->
                <button id="dropdown-button" type="button"
                    class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
                    {{ $category === 'all' ? 'Semua Posisi' : ucfirst(str_replace('_', ' ', $category)) }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden absolute mt-12 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li><button type="button" data-value="all"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua
                                Posisi</button></li>
                        <li><button type="button" data-value="admin"
                                class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" ">Admin</button>
                            </li>
                            <li><button type="button" data-value="dosen_pembimbing"
                                    class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dosen Pembimbing</button>
                            </li>
                            <li><button type="button" data-value="mahasiswa"
                                    class="category-btn w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mahasiswa</button>
                            </li>
                        </ul>
                    </div>

                    <!-- Search input -->
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown" name="search"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Cari pengguna berdasarkan nama atau email..." value="{{ $search ?? '' }}" />
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d=" m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                            </button>
                </div>
            </div>
        </form>


        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" onclick="location.href='{{ url('pengguna/create') }}'">Tambah Pengguna
        </button>
    </div>

    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Pengguna</th>
                    <th scope="col" class="px-6 py-3">Posisi</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $key => $userItem)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $user->firstItem() + $key }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if ($userItem->foto)
                                    <img src="{{ asset('storage/' . $userItem->foto) }}"
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
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ ucwords(str_replace('_', ' ', $userItem->role)) }}</td>
                        <td class="px-6 py-4">{{ $userItem->email }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <!-- Detail -->
                            <button
                                class="inline-flex items-center bg-blue-600 text-white  px-4 py-2 rounded-lg hover:bg-blue-700 transition cursor-pointer" onclick="location.href='{{ route('admin.pengguna.show', $userItem->id) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                
                                <span class="hidden md:inline">Detail</span>
                            </button>

                            <!-- Edit -->
                            <a href="{{ route('admin.pengguna.edit', $userItem->id) }}"
                                class="inline-flex items-center bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                <span class="hidden md:inline">Edit</span>
                            </a>

                            <!-- Hapus -->
                            <form action="{{ route('admin.pengguna.destroy', $userItem->id) }}" method="POST"
                                class="inline" id="delete-form-{{ $userItem->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="inline-flex items-center  bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm cursor-pointer btn-delete"
                                    data-id="{{ $userItem->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="hidden md:inline">Hapus</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-4">
            {{ $user->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id'); // Ambil ID dari data-id tombol
    
                // Menampilkan konfirmasi SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika ya, submit form untuk menghapus data
                        document.getElementById('delete-form-' + userId).submit();
                    }
                });
            });
        });
    </script>
    

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
