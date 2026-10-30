<?php

namespace App\Models;

use App\Models\Quiz\AnswerTes;
use App\Models\Quiz\Jadwal;
use App\Models\Quiz\JadwalXPelamar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\Print_;

class Pelamar extends Authenticatable
{
    use HasFactory;

    use Notifiable;

    protected $connection = 'ksb_karir';
    protected $table = 'tb_pelamar';
    protected $dates = ['created_at', 'tgl_lahir', 'tgl_status'];
    protected $primaryKey = 'id_pelamar';
    protected $guarded = ['id_pelamar'];

    protected $casts = [
        'tgl_lahir' => 'datetime',
    ];

    public function answer()
    {
        return $this->hasMany(AnswerTes::class, 'id_pelamar', 'id_pelamar');
    }

    public function printDokumen()
    {
        return $this->hasMany(PrintDokumen::class, 'id_pelamar', 'id_pelamar');
    }

    public function printResume()
    {
        return $this->hasMany(PrintResume::class, 'id_pelamar', 'id_pelamar');
    }


    public function tracking()
    {
        return $this->hasMany(TrackingLamaran::class, 'id_pelamar', 'id_pelamar');
    }


    public function jadwalpelamar()
    {
        return $this->hasMany(JadwalXPelamar::class, 'id_pelamar', 'id_pelamar');
    }


    public function jadwals()
    {
        return $this->belongsToMany(
            Jadwal::class,
            'tb_quiz_pivot_jadwal_pelamar', // nama tabel pivot
            'id_pelamar',                   // foreign key di pivot untuk pelamar
            'id_jadwal'                     // foreign key di pivot untuk jadwal
        );
    }


    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
