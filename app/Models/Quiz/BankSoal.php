<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_bank_soal';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    // protected $casts = [
    //     'opsi_jawaban' => 'array',
    // ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'id_kategori_soal', 'id');
    }

    public function answer()
    {
        return $this->hasMany(AnswerTes::class, 'id_soal', 'id');
    }
}
