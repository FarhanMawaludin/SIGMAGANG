@extends('layouts.mahasiswa-app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Hasil Rekomendasi Swara</h1>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-12 min-w-full mb-6">
        <div class="flex flex-col sm:flex-row items-center sm:items-end justify-center gap-10 sm:gap-20 text-center mt-6">
            @foreach ($top3 as $i => $data)
                @php
                    // Ukuran avatar dan margin atas
                    $uk_avatar = $i === 0 ? 'w-32 h-32' : 'w-24 h-24';
                    $mt_card = $i === 0 ? 'mt-0' : 'mt-12';
    
                    // Warna border avatar (emas, silver, perunggu)
                    $borderColors = ['border-yellow-400', 'border-gray-400', 'border-yellow-800'];
                    $border = $borderColors[$i] ?? 'border-gray-300';
    
                    // Gambar mahkota crown sesuai posisi
                    $crowns = ['gold-crown.png', 'silver-crown.png', 'bronze-crown.png'];
                    $crown = $crowns[$i] ?? null;
    
                    // Lebar mahkota crown
                    $crown_w = $i === 0 ? 'w-12' : 'w-10';
    
                    // Urutan tampilan di layar besar: juara 1 di tengah
                    $orderClasses = ['sm:order-1', 'sm:order-0', 'sm:order-2'];
                    $orderClass = $orderClasses[$i] ?? '';
    
                    // Style untuk juara 1 agar lebih tinggi di desktop
                    $style = $i === 0 ? 'transform: translateY(-30px);' : '';
                @endphp
    
                <div class="flex flex-col items-center gap-2 {{ $mt_card }} {{ $orderClass }}"
                    style="{{ $style }}">
                    <div class="relative">
                        {{-- Crown di atas avatar --}}
                        @if ($crown)
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 z-10">
                                <img src="{{ asset('images/' . $crown) }}" alt="Crown {{ $i + 1 }}"
                                    class="{{ $crown_w }}" />
                            </div>
                        @endif
    
                        {{-- Avatar dibungkus dalam lingkaran fleksibel agar rapi dan tidak rusak --}}
                        <div
                            class="{{ $uk_avatar }} rounded-full border-4 {{ $border }} overflow-hidden flex justify-center items-center bg-white">
                            <img src="{{ asset('storage/' . $data['lowongan']->perusahaan->foto) }}" alt="Avatar"
                                class="w-full h-full object-contain" />
                        </div>
                    </div>
    
                    <div class="font-bold text-lg">{{ $data['lowongan']->nama }}</div>
                    <div class="text-gray-500">{{ $data['lowongan']->perusahaan->nama ?? '-' }}</div>
    
                    <div class="bg-gray-200 rounded-full flex items-center px-4 py-2 mt-2">
                        <img src="https://img.icons8.com/color/48/000000/trophy.png" alt="Trophy" class="w-6 h-6 mr-2" />
                        <span class="font-bold text-blue-800 text-lg">{{ number_format($data['skor'], 3) }}</span>
                        <span class="ml-2 text-gray-600">Poin</span>
                    </div>
    
                    <a href="{{ route('mahasiswa.lowongan.show', $data['lowongan']->id) }}">
                        <button type="button"
                            class="cursor-pointer text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-full text-sm px-5 py-2 text-center transition-all duration-300 ease-in-out">
                            Lihat
                        </button>
                    </a>
                </div>
            @endforeach
        </div>
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

    <h2 class="font-semibold text-gray-800 mb-2 mt-4">Lowongan</h2>
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
                                    class=" text-white bg-blue-600 hover:bg-blue-800 font-semibold rounded-[8px] text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
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
