<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'deskripsi',
        'persyaratan',
        'batas_pendaftaran',
        'lokasi',
        'tipe_magang',
        'jumlah_magang',
        'perusahaan_id',
        'periode_id',
        'prodi_id',
    ];

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }

    public function dokumenLowongans(): HasMany
    {
        return $this->hasMany(DokumenLowongan::class);
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'lowongan_skill', 'lowongan_id', 'skill_id');
    }

    public function jenisMagang(): BelongsTo
    {
        return $this->belongsTo(JenisMagang::class);
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'lowongan_id');
    }
}
