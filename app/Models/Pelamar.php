<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;
    protected $table = 'tb_pelamar';
    protected $dates = ['created_at', 'tgl_lahir', 'tgl_status'];
    protected $primaryKey = 'id_pelamar';
    protected $guarded = ['id_pelamar'];

    public function Penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class, 'id_penjadwalan', 'id_penjadwalan');
    }
}
