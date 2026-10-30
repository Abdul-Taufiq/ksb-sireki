<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintDokumen extends Model
{
    use HasFactory;
    protected $connection = 'ksb_karir';
    protected $table = 'tb_print_dokumen';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $casts = [
        'tgl_pk' => 'datetime',
        'tgl_ijazah' => 'datetime',
        'tgl_penyerahan' => 'datetime',
        'tgl_print_pakta' => 'datetime',
        'tgl_print_kode_etik' => 'datetime',
        'tgl_print_ba_jamker' => 'datetime',
        'tgl_print_sp_slik' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }
}
