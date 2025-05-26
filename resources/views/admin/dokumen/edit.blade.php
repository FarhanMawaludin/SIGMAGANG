@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Edit Document (Admin)</h1>
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

        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Replace File (Max 5MB, optional):</label>
                <input type="file" name="file" id="file" class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('file') border-red-500 @enderror">
                @error('file')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
                @if ($dokumen->file_path)
                    <p class="text-gray-600 text-sm mt-2">Current file: <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($dokumen->file_path) }}</a></p>
                @endif
            </div>

            {{-- Display the current document type as a dropdown for editing --}}
            <div class="mb-4">
                <label for="tipe" class="block text-gray-700 text-sm font-bold mb-2">Document Type:</label>
                <select name="tipe" id="tipe" class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tipe') border-red-500 @enderror">
                    <option value="">Select Type</option>
                    <option value="CV" {{ old('tipe', $dokumen->tipe) == 'CV' ? 'selected' : '' }}>CV</option>
                    <option value="Sertifikat" {{ old('tipe', $dokumen->tipe) == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                    <option value="Transkrip Nilai" {{ old('tipe', $dokumen->tipe) == 'Transkrip Nilai' ? 'selected' : '' }}>Transkrip Nilai</option>
                </select>
                @error('tipe')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4 mt-6">
                <a href="{{ route('admin.dokumen.index') }}" class="inline-flex items-center bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition cursor-pointer">Cancel</a>
                <button type="submit" class="inline-flex items-center bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition cursor-pointer">Update Document</button>
            </div>
        </form>
    </div>
@endsection
