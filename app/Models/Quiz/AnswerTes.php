<?php

namespace App\Models\Quiz;

use App\Models\Pelamar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerTes extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_answer';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function banksoal()
    {
        return $this->belongsTo(BankSoal::class, 'id_soal', 'id');
    }

    public function pelamar()
    {
        return $this->belon0gsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }
}
