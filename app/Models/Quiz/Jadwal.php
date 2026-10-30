<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_jadwal';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $casts = [
        'tgl_jadwal' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];

    public function jadwalpelamar()
    {
        return $this->hasMany(JadwalXPelamar::class, 'id_jadwal', 'id');
    }
}
