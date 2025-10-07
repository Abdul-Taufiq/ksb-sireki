<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'access_quiz';
    protected $primaryKey = 'id';
    protected $dates =['updated_at', 'start', 'date'];
}
