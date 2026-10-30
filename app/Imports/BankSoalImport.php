<?php

namespace App\Imports;

use App\Models\Quiz\BankSoal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BankSoalImport implements ToModel, WithHeadingRow
{
    protected $idKategoriSoal;
    protected $namaTes;
    protected $jnsTes;

    public function __construct($idKategoriSoal, $namaTes, $jnsTes)
    {
        $this->idKategoriSoal = $idKategoriSoal;
        $this->namaTes = $namaTes;
        $this->jnsTes = $jnsTes;
    }

    public function model(array $row)
    {
        // Abaikan baris kosong
        if (empty(array_filter($row))) {
            return null;
        }

        return new BankSoal([
            'id_kategori_soal' => $this->idKategoriSoal,
            'nama_tes'         => $this->namaTes,
            'jns_tes'          => $this->jnsTes,
            'pertanyaan'       => $row['pertanyaan'] ?? null,
            'opsi_jawaban'     => $row['opsi_jawaban'] ?? null,
            'kunci_jawaban'    => $row['kunci_jawaban'] ?? null,
        ]);
    }
}
