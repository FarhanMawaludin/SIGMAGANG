@extends('layouts.dosen-app')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Feedback</h1>
    </div>
    <div class="w-full bg-white p-8 rounded-lg border border-gray-200">


        {{-- Tampilkan pesan error jika ada --}}
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('dosen.monitoring.update_feedback', $logMingguan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="dosen_feedback" class="block text-sm font-medium text-gray-700 mb-1">Feedback</label>
                <textarea id="dosen_feedback" name="dosen_feedback" rows="5"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    placeholder="Tulis feedback di sini..."></textarea>
            </div>

            <div class="col-span-full mt-4 flex items-center justify-start gap-x-6">
                <button type="submit"
                    class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>

            {{-- <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-semibold shadow transition">
                    Simpan Feedback
                </button>
            </div> --}}
        </form>
    </div>
@endsection
