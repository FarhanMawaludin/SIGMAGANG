<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $primaryKey = 'id';
    protected $fillable = ['nama'];

    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
    public function dosenPembimbing(): HasMany
    {
        return $this->hasMany(DosenPembimbing::class); 
    }
}
