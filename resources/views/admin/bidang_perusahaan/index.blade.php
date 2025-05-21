@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Bidang Perusahaan</h1>
    <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" onclick="location.href='{{ url('bidang_perusahaan/create') }}'">Tambah
        </button>
    {{-- <a href="{{ route('bidang_perusahaan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        Tambah
    </a> --}}
</div>

<div class="overflow-x-auto relative rounded-lg border border-gray-200">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama Bidang</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bidang_perusahaan as $index => $item)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $item->nama_bidang }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <!-- Edit -->
                            <a href="{{ route('admin.bidang_perusahaan.edit', $item->id) }}"
                                class="flex items-center bg-orange-500 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-orange-700 text-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.bidang_perusahaan.destroy', $item->id) }}" method="POST"
                                class="inline" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm cursor-pointer btn-delete"
                                    data-id="{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="hidden md:inline">Hapus</span>
                                </button>
                            </form>

                            {{-- <!-- Hapus -->
                            <form action="{{ route('admin.bidang_perusahaan.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                class="flex items-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 text-sm whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center px-6 py-4 text-gray-500">Tidak ada data bidang perusahaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4">
        {{ $bidang_perusahaan->links('pagination::tailwind') }}
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
@endsection
