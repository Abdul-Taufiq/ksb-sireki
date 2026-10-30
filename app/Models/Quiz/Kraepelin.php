<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kraepelin extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_quiz_kraepelin';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function answer()
    {
        return $this->hasMany(KraepelinAnswer::class, 'id_soal', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'id_kategori_soal', 'id');
    }
}
