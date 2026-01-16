<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'documentable_id',
        'documentable_type',
        'tipe',
        'file_path',
    ];
    public function isMahasiswa(): bool
    {
        return $this->pemilik_tipe === 'mahasiswa';
    }

    public function isDosen(): bool
    {
        return $this->pemilik_tipe === 'dosen_pembimbing';
    }

    public function isValid(): bool
    {
        return $this->status === 'valid';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isInvalid(): bool
    {
        return $this->status === 'invalid';
    }

    public function documentable()
    {
        return $this->morphTo();
    }
}
