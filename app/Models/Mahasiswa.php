<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'ipk',
        'preferensi_lokasi',
        'jenis_magang_id',
        'user_id',
        'tipe_magang',
        'semester',
        'no_telp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    public function documents()
    {
        return $this->morphMany(Dokumen::class, 'documentable');
    }
    public function jenisMagang()
    {
        return $this->belongsTo(JenisMagang::class, 'jenis_magang_id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
    // baru

    public function isCompleteProfile(): bool
    {
        return $this->nim &&
            $this->user && $this->user->name &&
            $this->prodi &&
            $this->ipk &&
            $this->preferensi_lokasi &&
            $this->jenis_magang_id &&
            $this->tipe_magang &&
            $this->no_telp &&
            $this->semester;
    }
}
