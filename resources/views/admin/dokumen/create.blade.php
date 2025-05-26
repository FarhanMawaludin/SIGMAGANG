@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Upload New Documents</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Corrected form action to route('dokumen.store') --}}
        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6 border border-gray-200 p-4 rounded-md shadow-sm">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Document 1</h2>
                <div class="mb-4">
                    <label for="file1" class="block text-gray-700 text-sm font-bold mb-2">File (Max 5MB):</label>
                    <input type="file" name="file[]" id="file1" class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('file.0') border-red-500 @enderror">
                    @error('file.0')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tipe1" class="block text-gray-700 text-sm font-bold mb-2">Document Type:</label>
                    <select name="tipe[]" id="tipe1" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tipe.0') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="CV" {{ old('tipe.0') == 'CV' ? 'selected' : '' }}>CV</option>
                        <option value="Sertifikat" {{ old('tipe.0') == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                        <option value="Transkrip Nilai" {{ old('tipe.0') == 'Transkrip Nilai' ? 'selected' : '' }}>Transkrip Nilai</option>
                    </select>
                    @error('tipe.0')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6 border border-gray-200 p-4 rounded-md shadow-sm">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Document 2 (Optional)</h2>
                <div class="mb-4">
                    <label for="file2" class="block text-gray-700 text-sm font-bold mb-2">File (Max 5MB):</label>
                    <input type="file" name="file[]" id="file2" class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('file.1') border-red-500 @enderror">
                    @error('file.1')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tipe2" class="block text-gray-700 text-sm font-bold mb-2">Document Type:</label>
                    <select name="tipe[]" id="tipe2" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tipe.1') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="CV" {{ old('tipe.1') == 'CV' ? 'selected' : '' }}>CV</option>
                        <option value="Sertifikat" {{ old('tipe.1') == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                        <option value="Transkrip Nilai" {{ old('tipe.1') == 'Transkrip Nilai' ? 'selected' : '' }}>Transkrip Nilai</option>
                    </select>
                    @error('tipe.1')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6 border border-gray-200 p-4 rounded-md shadow-sm">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Document 3 (Optional)</h2>
                <div class="mb-4">
                    <label for="file3" class="block text-gray-700 text-sm font-bold mb-2">File (Max 5MB):</label>
                    <input type="file" name="file[]" id="file3" class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('file.2') border-red-500 @enderror">
                    @error('file.2')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tipe3" class="block text-gray-700 text-sm font-bold mb-2">Document Type:</label>
                    <select name="tipe[]" id="tipe3" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tipe.2') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="CV" {{ old('tipe.2') == 'CV' ? 'selected' : '' }}>CV</option>
                        <option value="Sertifikat" {{ old('tipe.2') == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                        <option value="Transkrip Nilai" {{ old('tipe.2') == 'Transkrip Nilai' ? 'selected' : '' }}>Transkrip Nilai</option>
                    </select>
                    @error('tipe.2')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 mt-6">
                <a href="{{ route('admin.dokumen.index') }}" class="inline-flex items-center bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition cursor-pointer">Cancel</a>
                <button type="submit" class="inline-flex items-center bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition cursor-pointer">Upload Documents</button>
            </div>
        </form>
    </div>
@endsection
