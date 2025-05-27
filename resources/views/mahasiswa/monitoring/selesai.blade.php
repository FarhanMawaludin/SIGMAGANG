{{-- filepath: c:\coolyeah\SEM4\SIGMAGANG-NEW\resources\views\mahasiswa\monitoring\selesai.blade.php --}}
@extends('layouts.mahasiswa-app')
@section('content')

    <form method="POST" action="{{ route('mahasiswa.monitoring.surat_keterangan') }}" enctype="multipart/form-data" id="form-surat-keterangan">
        @csrf
        @method('PUT')
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Upload Surat Keterangan Magang</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
            <div class="mb-4">
                <label for="surat_keterangan" class="block text-sm font-medium text-gray-900">Surat Keterangan Magang (PDF, max 1 file)</label>
                <input type="file" id="surat_keterangan" name="surat_keterangan" accept="application/pdf"
                    class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>
            <div class="mt-6 flex items-center gap-x-6">
                <a href="{{ route('mahasiswa.profil.index') }}"
                    class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm">Simpan</button>
            </div>
        </div>
    </form>

    {{-- SweetAlert --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#16a34a'
        });
    </script>
    @endif
@endsection