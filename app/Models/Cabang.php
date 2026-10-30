<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';

    public function User()
    {
        return $this->hasMany(User::class, 'id_cabang', 'id_cabang');
    }

    public function loker()
    {
        return $this->hasMany(Loker::class, 'id_cabang', 'id_cabang');
    }

    public function pelamar()
    {
        return $this->hasMany(Pelamar::class, 'id_cabang', 'id_cabang');
    }

    public function printDokumen()
    {
        return $this->hasMany(PrintDokumen::class, 'id_cabang', 'id_cabang');
    }
}
