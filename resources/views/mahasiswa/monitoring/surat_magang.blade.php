<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 4px 3px;
        }

        th {
            text-align: left;
        }

        .d-block {
            display: block;
        }

        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .p-1 {
            padding: 5px 1px 5px 1px;
        }

        .font-10 {
            font-size: 10pt;
        }

        .font-11 {
            font-size: 11pt;
        }

        .font-12 {
            font-size: 12pt;
        }

        .font-13 {
            font-size: 13pt;
        }

        .border-bottom-header {
            border-bottom: 1px solid;
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }

        .judul-surat {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 20px;
        }

        .judul-surat h2 {
            text-transform: uppercase;
            font-size: 16pt;
            margin: 0;
        }

        .judul-surat p {
            margin: 2px 0;
            font-size: 12pt;
        }

        .isi {
            margin-top: 30px;
        }

        .isi p {
            margin: 6px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .bold {
            font-weight: bold;
        }

        .ttd {
            margin-top: 60px;
            text-align: right;
        }

        .ttd p {
            margin: 2px 0;
        }

        .footer {
            margin-top: 40px;
        }

        .section {
            margin-bottom: 20px;
            font-size: 12pt;
            white-space: pre-line;
        }

        .line {
            display: block;
        }

        .label {
            display: inline-block;
            width: 160px;
        }
    </style>
</head>

<body>
    <table class="border-bottom-header" style="width: 100%;">
        <tr>
            <td width="15%" class="text-center">
                <img src="images/Logo/Polinema.png" style="max-height: 80px; width: auto;">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">
                    KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI
                </span>
                <span class="text-center d-block font-13 font-bold mb-1">
                    POLITEKNIK NEGERI MALANG
                </span>
                <span class="text-center d-block font-10">
                    Jl. Soekarno-Hatta No. 9 Malang 65141
                </span>
                <span class="text-center d-block font-10">
                    Telepon (0341) 404424 Pes. 101 105, 0341-404420, Fax. (0341) 404420
                </span>
                <span class="text-center d-block font-10">
                    Laman: www.polinema.ac.id
                </span>
            </td>
        </tr>
    </table>
    <div class="judul-surat">
        <h2>SURAT KETERANGAN MAGANG</h2>
        <p>Nomor: {{ $nomor_surat }}</p>
    </div>

    <div class="isi">

        <div class="section">
            <p>Yang bertanda tangan di bawah ini:</p>
            <div class="line"><span class="label">Dosen Pembimbing</span>: {{ $dosen->user->name }}</div>
            <div class="line"><span class="label">NIDN</span>: {{ $dosen->nidn }}</div>
        </div>

        <div class="section">
            <p>Dengan ini menerangkan bahwa:</p>
            <div class="line"><span class="label">Nama Mahasiswa</span>: {{ $mahasiswa->user->name }}</div>
            <div class="line"><span class="label">NIM</span>: {{ $mahasiswa->nim }}</div>
            <div class="line"><span class="label">Program Studi</span>: {{ $mahasiswa->prodi->nama }}</div>
        </div>


        <p style="line-height: 1.5">Surat keterangan ini dibuat sebagai bukti telah menyelesaikan kegiatan magang di
            <span class="bold">{{ $perusahaan }}</span> dan dapat digunakan untuk
            keperluan administrasi akademik atau lainnya yang berkaitan.
        </p>


        <div class="ttd">
            <p>Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <br><br><br><br><br>
            <p class="bold">{{ $dosen->user->name }}</p>
            <p>NIDN: {{ $dosen->nidn }}</p>
        </div>

    </div>

</body>

</html>
