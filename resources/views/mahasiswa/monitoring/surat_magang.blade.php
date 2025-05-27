<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan Magang</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin: 0 40px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SURAT KETERANGAN MAGANG</h2>
        <p>Nomor: {{ $nomor_surat }}</p>
    </div>
    <div class="content">
        <p>Yang bertanda tangan di bawah ini:</p>
        <p>Nama Dosen Pembimbing: <b>{{ $dosen->user->name }}</b></p>
        <p>NIDN: <b>{{ $dosen->nidn }}</b></p>
        <br>
        <p>Menerangkan bahwa:</p>
        <p>Nama Mahasiswa: <b>{{ $mahasiswa->user->name }}</b></p>
        <p>NIM: <b>{{ $mahasiswa->nim }}</b></p>
        <p>Prodi: <b>{{ $mahasiswa->prodi->nama }}</b></p>
        <p>Telah menyelesaikan magang di <b>{{ $perusahaan }}</b> pada tanggal <b>{{ $tanggal_mulai }}</b> sampai <b>{{ $tanggal_selesai }}</b>.</p>
        <br>
        <p>Demikian surat ini dibuat untuk digunakan sebagaimana mestinya.</p>
        <br><br>
        <p>Yogyakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <br><br>
        <p><b>{{ $dosen->user->name }}</b></p>
        <p>NIDN: {{ $dosen->nidn }}</p>
    </div>
</body>
</html>