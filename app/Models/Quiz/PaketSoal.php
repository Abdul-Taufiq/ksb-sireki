<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_paket_soal';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function paketkategori()
    {
        return $this->hasMany(PaketXKategori::class, 'id_paket', 'id');
    }
}
