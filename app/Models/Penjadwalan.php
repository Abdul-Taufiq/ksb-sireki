<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $table='tb_penjadwalan';
    protected $dates =['created_at', 'tgl_test'];
    protected $primaryKey = 'id_penjadwalan';

    public function Pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    public function Loker()
    {
        return $this->belongsTo(Loker::class, 'id_loker', 'id_loker');
    }

    
}
