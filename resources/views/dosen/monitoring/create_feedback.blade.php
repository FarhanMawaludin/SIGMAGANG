@extends('layouts.dosen-app')
@section('content')
<div class="w-full bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Feedback</h1>
    </div>

    {{-- Tampilkan pesan error jika ada --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('dosen.monitoring.update_feedback',$logHarian->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="log_mingguan_id" value="{{ $logHarian->id }}">
        <div>
            <label for="dosen_feedback" class="block text-sm font-medium text-gray-700 mb-1">Feedback</label>
            <textarea id="dosen_feedback" name="dosen_feedback" rows="5"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-3 resize-none"
                placeholder="Tulis feedback di sini..."></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-semibold shadow transition">
                Simpan Feedback
            </button>
        </div>
    </form>
</div>
@endsection