<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMagang extends Model
{
    use HasFactory;
    protected $table = 'jenis_magang';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_magang'];

    public function mahasiswa() {
        return $this->hasmany(Mahasiswa::class);
    }
    public function lowongan() {
        return $this->hasmany(Lowongan::class);
    }
    public function dosenPembimbing() {
        return $this->hasmany(DosenPembimbing::class);
    }
}
