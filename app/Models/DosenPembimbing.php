<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenPembimbing extends Model
{
    use HasFactory;
    protected $table = 'dosen_pembimbing';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nidn',
        'nama',
        'jabatan',
        'departemen',
        'no_telp',
        'preferensi_lokasi',
        'jenis_magang_id',
        'prodi_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function documents() {
    return $this->morphMany(Dokumen::class, 'documentable');
}

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
    public function jenisMagang()
    {
        return $this->belongsTo(JenisMagang::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'dosen_id');
    }

    //baru
}
