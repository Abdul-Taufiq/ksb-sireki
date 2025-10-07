<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleSoal extends Model
{
    use HasFactory;
    protected $table = 'tb_example_soal';
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function ExampleJawaban()
    {
        return $this->hasMany(ExampleJawaban::class, 'soal_id', 'id');
    }
}
