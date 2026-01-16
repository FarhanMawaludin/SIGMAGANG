@extends('layouts.app')

@section('content')
<form action="{{ route('skill.update',$skill->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="space-y-12">
        <h2 class="text-[28px] font-semibold text-gray-900 mb-4">Update Skill</h2>
        <div class="border-b border-gray-900/10 pb-12 p-6 bg-white border border-gray-200 rounded-lg">
            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                    <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama Skill</label>
                    <div class="mt-2">
                        <input id="nama" name="nama" type="text" value="{{$skill->nama }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <button type="button"
                    class="text-sm/6 font-semibold text-gray-900 hover:text-gray-900 hover:border border-gray-900 rounded-md px-3 py-2" onclick="location.href='{{ route('skill.index') }}'">Batal</button>
                <button type="submit"
                    class="bg-indigo-600 rounded-md px-3 py-2 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
