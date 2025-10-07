<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table='tracking';
    protected $primaryKey = 'id_tracking';

    // public function Debitur()
    // {
    //     return $this->belongsTo(Debitur::class, 'id_debitur', 'id_debitur');
    // }

}
