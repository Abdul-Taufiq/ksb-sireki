<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_loker';
    protected $dates = ['created_at', 'tgl_berakhir'];
    protected $primaryKey = 'id_loker';

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
