<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogMingguan extends Model
{
    use HasFactory;
    protected $table = 'log_mingguan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pengajuan_id',
        'minggu',
        'tanggal_awal',
        'tanggal_akhir',
        'mahasiswa_feedback',
        'dosen_feedback',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }


    public function logHarian()
    {
        return $this->hasMany(LogHarian::class, 'log_mingguan_id');
    }
}
