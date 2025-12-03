<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogHarian extends Model
{
    use HasFactory;
    protected $table = 'log_harian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'aktivitas',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'log_mingguan_id',
    ];

    public function logMingguan()
    {
        return $this->belongsTo(LogMingguan::class, 'log_mingguan_id');
    }
}
