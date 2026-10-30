<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketXKategori extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_pivot_paket_kategori';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function paket()
    {
        return $this->belongsTo(PaketSoal::class, 'id_paket', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'id_kategori_soal', 'id');
    }
}
