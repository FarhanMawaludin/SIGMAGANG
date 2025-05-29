<p>Halo {{ $pengajuan->mahasiswa->user->name }},</p>
<p>Status pengajuan magang Anda di <b>{{ $pengajuan->lowongan->perusahaan->nama }}</b> telah berubah menjadi: <b>{{ strtoupper($status) }}</b>.</p>
<p>Terima kasih.</p>