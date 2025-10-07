<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    protected $table='tb_loker';
    protected $dates =['created_at', 'tgl_berakhir'];
    protected $primaryKey = 'id_loker';

    public function Penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class, 'id_penjadwalan', 'id_penjadwalan');
    }
}
