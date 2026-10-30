<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingLamaran extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_tracking_lamaran';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $casts = [
        'tgl_status' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }
}
