@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Hasil Rekomendasi Swara</h1>
    </div>


    <h2 class="font-semibold text-gray-800 mb-2">Normalisasi</h2>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-center text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left">Nama Lowongan</th>
                    <th scope="col" class="px-6 py-3">Skill</th>
                    <th scope="col" class="px-6 py-3">IPK</th>
                    <th scope="col" class="px-6 py-3">Lokasi</th>
                    <th scope="col" class="px-6 py-3">Jenis Magang</th>
                    <th scope="col" class="px-6 py-3">Tipe Magang</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $row)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 text-left font-medium">{{ $row['lowongan']->nama }}</td>
                        <td class="px-6 py-4">{{ number_format($row['nilai']['skills'], 3) }}</td>
                        <td class="px-6 py-4">{{ $row['nilai']['ipk'] }}</td>
                        <td class="px-6 py-4">{{ $row['nilai']['lokasi'] }}</td>
                        <td class="px-6 py-4">{{ $row['nilai']['jenis_magang'] }}</td>
                        <td class="px-6 py-4">{{ $row['nilai']['tipe_magang'] }}</td>
                        <td class="px-6 py-4">{{ $row['nilai']['prodi'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada Rekomendasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="font-semibold text-gray-800 mb-2 mt-4">Skor</h2>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-center text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left">Nama Lowongan</th>
                    <th scope="col" class="px-6 py-3">Skill</th>
                    <th scope="col" class="px-6 py-3">IPK</th>
                    <th scope="col" class="px-6 py-3">Lokasi</th>
                    <th scope="col" class="px-6 py-3">Jenis Magang</th>
                    <th scope="col" class="px-6 py-3">Tipe Magang</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Skor</th>
                    <th scope="col" class="px-6 py-3">Ranking</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $index => $data)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 text-left font-medium">{{ $data['lowongan']->nama }}</td>
                        <td class="px-6 py-4">{{ number_format($data['nilai']['skills'] * $bobot['skills'], 3) }}</td>
                        <td class="px-6 py-4">{{ number_format($data['nilai']['ipk'] * $bobot['ipk'], 3) }}</td>
                        <td class="px-6 py-4">{{ number_format($data['nilai']['lokasi'] * $bobot['lokasi'], 3) }}</td>
                        <td class="px-6 py-4">
                            {{ number_format($data['nilai']['jenis_magang'] * $bobot['jenis_magang'], 3) }}</td>
                        <td class="px-6 py-4">{{ number_format($data['nilai']['tipe_magang'] * $bobot['tipe_magang'], 3) }}
                        </td>
                        <td class="px-6 py-4">{{ number_format($data['nilai']['prodi'] * $bobot['prodi'], 3) }}</td>
                        <td class="px-6 py-4"><strong>{{ number_format($data['skor'], 3) }}</strong></td>
                        <td class="px-6 py-4"><strong>{{ $index + 1 }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada Rekomendasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="font-semibold text-gray-800 mb-2 mt-4">Rekomendasi Lowongan Anda</h2>
    <div class="overflow-x-auto relative rounded-lg border border-gray-200">
        <table class="min-w-full text-sm text-center text-gray-700">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left">Nama Lowongan</th>
                    <th scope="col" class="px-6 py-3">Skor</th>
                    <th scope="col" class="px-6 py-3">Ranking</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $index => $data)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4 text-left font-medium">{{ $data['lowongan']->nama }}</td>
                        <td class="px-6 py-4"><strong>{{ number_format($data['skor'], 3) }}</strong></td>
                        <td class="px-6 py-4"><strong>{{ $index + 1 }}</strong></td>
                        <td class="px-6 py-4">
                            <a href="{{ route('mahasiswa.lowongan.show', $data['lowongan']->id) }}">
                                <button type="button"
                                    class=" cursor-pointer text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
                                    Lihat Detail
                                </button>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada Rekomendasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $hasil->links() }}
        </div>
    </div>

    
@endsection
