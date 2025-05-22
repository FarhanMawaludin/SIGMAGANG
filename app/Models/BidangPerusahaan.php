<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'bidang_perusahaan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_bidang'];

    public function perusahaan()
    {
        return $this->hasMany(Perusahaan::class);
    }
}
