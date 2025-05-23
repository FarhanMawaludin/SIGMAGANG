@extends('layouts.mahasiswa-app')

@section('content')
    <div class="container py-4">
        <h2 class="text-xl font-semibold mb-4">Hasil Rekomendasi Lowongan</h2>

        <table class="min-w-full border text-sm bg-white shadow-md rounded overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 text-left">
                <tr>
                    <th class="p-3 border">Nama Lowongan</th>
                    <th class="p-3 border">Skills</th>
                    <th class="p-3 border">IPK</th>
                    <th class="p-3 border">Lokasi</th>
                    <th class="p-3 border">Jenis Magang</th>
                    <th class="p-3 border">Tipe Magang</th>
                    <th class="p-3 border">Prodi</th>
                    <th class="p-3 border font-bold">Total Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $row)
                    <tr class="border-t">
                        <td class="p-3 border">{{ $row['lowongan']->nama }}</td>
                        <td class="p-3 border text-center">{{ number_format($row['nilai']['skills'], 3) }}</td>
                        <td class="p-3 border text-center">{{ $row['nilai']['ipk'] }}</td>
                        <td class="p-3 border text-center">{{ $row['nilai']['lokasi'] }}</td>
                        <td class="p-3 border text-center">{{ $row['nilai']['jenis_magang'] }}</td>
                        <td class="p-3 border text-center">{{ $row['nilai']['tipe_magang'] }}</td>
                        <td class="p-3 border text-center">{{ $row['nilai']['prodi'] }}</td>
                        <td class="p-3 border text-center font-semibold text-blue-600">{{ number_format($row['skor'], 3) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h1>Rekomendasi Magang untuk: {{ $mahasiswa->user->name }}</h1>

        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #eee;">
                    <th>Ranking</th>
                    <th>Lowongan</th>
                    <th>Skills (Skor)</th>
                    <th>IPK (Skor)</th>
                    <th>Lokasi (Skor)</th>
                    <th>Jenis Magang (Skor)</th>
                    <th>Tipe Magang (Skor)</th>
                    <th>Prodi (Skor)</th>
                    <th>Skor Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data['lowongan']->nama }}</td>
                        <td>{{ number_format($data['nilai']['skills'] * $bobot['skills'], 3) }}</td>
                        <td>{{ number_format($data['nilai']['ipk'] * $bobot['ipk'], 3) }}</td>
                        <td>{{ number_format($data['nilai']['lokasi'] * $bobot['lokasi'], 3) }}</td>
                        <td>{{ number_format($data['nilai']['jenis_magang'] * $bobot['jenis_magang'], 3) }}</td>
                        <td>{{ number_format($data['nilai']['tipe_magang'] * $bobot['tipe_magang'], 3) }}</td>
                        <td>{{ number_format($data['nilai']['prodi'] * $bobot['prodi'], 3) }}</td>
                        <td><strong>{{ number_format($data['skor'], 3) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
