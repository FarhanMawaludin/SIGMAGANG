@extends('layouts.mahasiswa-app')

@section('content')
    <form method="POST" action="{{ route('mahasiswa.dokumen.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Edit & Upload Dokumen</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">

            <div class="mb-4">
                <label for="cv" class="block text-sm font-medium text-gray-900">CV (PDF, max 1 file)</label>
                <input type="file" id="cv" name="cv" accept="application/pdf"
                    class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>

            <div class="mb-4">
                <label for="transkrip" class="block text-sm font-medium text-gray-900">Transkrip Nilai (PDF, max 1 file)</label>
                <input type="file" id="transkrip" name="transkrip" accept="application/pdf"
                    class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>

            <div class="mb-4">
                <label for="pengantar" class="block text-sm font-medium text-gray-900">Surat Pengantar (PDF, max 1 file)</label>
                <input type="file" id="pengantar" name="pengantar" accept="application/pdf"
                    class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>

            <div class="mb-4">
                <label for="sertifikat" class="block text-sm font-medium text-gray-900">Sertifikat (PDF/JPG, max 3 file)</label>
                <input type="file" id="sertifikat" name="sertifikat[]" accept="application/pdf,image/*" multiple
                    class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <p class="mt-1 text-sm text-gray-500">Maksimal 3 file sertifikat</p>
            </div>

            <div class="mt-6 flex items-center gap-x-6">
                <a href="{{ route('mahasiswa.profil.index') }}"
                    class="text-sm font-semibold text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2">Batal</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-500 rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection
