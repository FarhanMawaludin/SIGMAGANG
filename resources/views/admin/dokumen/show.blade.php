@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Document Details (Admin View)</h1>
    </div>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200 bg-white">
        {{-- Foto Profil (Placeholder, if applicable) --}}
        {{-- You might remove this if documents don't have associated photos --}}
        <div class="flex justify-center py-6">
            <img src="{{ asset('images/Profile.jpg') }}" alt="Default Photo"
                class="w-32 h-32 rounded-full border border-gray-200 object-cover shrink-0">
        </div>

        {{-- Tabel Informasi --}}
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 w-1/3">Information</th>
                    <th scope="col" class="px-6 py-3">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Document ID</td>
                    <td class="px-6 py-4">{{ $dokumen->id }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Document Type</td>
                    <td class="px-6 py-4">{{ $dokumen->tipe }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">File Name</td>
                    <td class="px-6 py-4">
                        <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ basename($dokumen->file_path) }}
                        </a>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Status</td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-orange-100 text-orange-600',
                                'approved' => 'bg-green-100 text-green-600',
                                'rejected' => 'bg-red-100 text-red-600',
                            ];
                        @endphp
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Uploaded By (Type)</td>
                    <td class="px-6 py-4">{{ $dokumen->documentable_type }}</td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4 font-medium">Uploaded By (ID)</td>
                    <td class="px-6 py-4">{{ $dokumen->documentable_id }}</td>
            </tbody>
        </table>

        {{-- Tombol Kembali --}}
        <div class="text-center py-6">
            <a href="{{ route('admin.dokumen.index') }}"
                class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Document List
            </a>
        </div>
    </div>
@endsection
