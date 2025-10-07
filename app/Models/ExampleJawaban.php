<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleJawaban extends Model
{
    use HasFactory;
    protected $table = 'tb_example_jawaban';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function ExampleSoal()
    {
        return $this->belongsTo(ExampleSoal::class, 'soal_id', 'soal_id');
    }
}
