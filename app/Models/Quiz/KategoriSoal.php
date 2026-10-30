<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSoal extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_kategori_soal';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function paketkategori()
    {
        return $this->hasMany(PaketXKategori::class, 'id_kategori_soal', 'id');
    }

    public function banksoal()
    {
        return $this->hasMany(BankSoal::class, 'id_kategori_soal', 'id');
    }

    public function kraepelin()
    {
        return $this->hasMany(Kraepelin::class, 'id_kategori_soal', 'id');
    }
}
