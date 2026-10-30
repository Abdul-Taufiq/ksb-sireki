<?php

namespace App\Models\Quiz;

use App\Models\Pelamar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalXPelamar extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_pivot_jadwal_pelamar';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id');
    }

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }
}
