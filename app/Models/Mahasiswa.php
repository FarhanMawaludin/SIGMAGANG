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
        'lokasi_preferensi',
        'user_id'       
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
    public function skills() {
        return $this->belongsToMany(Skill::class);
    }
    public function documents() {
        return $this->morphMany(Dokumen::class, 'documentable');
    }
    public function jenisMagang()
{
    return $this->belongsTo(JenisMagang::class);
}

}
