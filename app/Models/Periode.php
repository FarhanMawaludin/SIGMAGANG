<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $primaryKey = 'id';
    protected $fillable = ['deskripsi','tanggal_mulai','tanggal_selesai'];

    public function lowongan(): HasMany
    {
        return $this->hasMany(Lowongan::class);
    }
}
