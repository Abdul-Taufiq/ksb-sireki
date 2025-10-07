<?php

namespace App\Http\Controllers;

use App\Models\ExampleSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;

class ExampleController extends Controller
{
    public function index()
    {
        $data = ExampleSoal::all();
        return view('example', [
            'text' => '',
            'data' => $data
        ]);
    }


    // 1 JAWABAN
    // public function store(Request $request)
    // {
    //     $file = $request->file('word_file');
    //     $path = $file->store('word_docs');

    //     $phpWord = IOFactory::load(storage_path('app/' . $path));
    //     $text = '';

    //     foreach ($phpWord->getSections() as $section) {
    //         foreach ($section->getElements() as $element) {
    //             if (method_exists($element, 'getText')) {
    //                 $text .= $element->getText() . "\n";
    //             }
    //         }
    //     }

    //     $lines = explode("\n", $text);
    //     $pendingSoal = null;

    //     foreach ($lines as $line) {
    //         $line = trim($line);

    //         if (str_starts_with($line, '==')) {
    //             // Jika ada soal sebelumnya yang belum disimpan, simpan dengan jawaban null
    //             if ($pendingSoal !== null) {
    //                 ExampleSoal::create([
    //                     'soal' => $pendingSoal,
    //                     'jawaban' => null,
    //                 ]);
    //             }

    //             // Simpan soal baru ke buffer
    //             $pendingSoal = ltrim($line, '= ');
    //         } elseif (str_starts_with($line, '**')) {
    //             // Simpan soal + jawaban
    //             if ($pendingSoal !== null) {
    //                 $jawaban = ltrim($line, '* ');
    //                 ExampleSoal::create([
    //                     'soal' => $pendingSoal,
    //                     'jawaban' => $jawaban,
    //                 ]);
    //                 $pendingSoal = null;
    //             }
    //         }
    //     }

    //     // Jika masih ada soal tersisa di akhir file tanpa jawaban
    //     if ($pendingSoal !== null) {
    //         ExampleSoal::create([
    //             'soal' => $pendingSoal,
    //             'jawaban' => null,
    //         ]);
    //     }

    //     return back()->with('success', 'Semua soal dan jawaban berhasil disimpan!');
    // }


    // PILIHAN GANDA
    public function store(Request $request)
    {
        $file = $request->file('word_file');
        $path = $file->store('word_docs');

        $phpWord = IOFactory::load(storage_path('app/' . $path));
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }

        $lines = explode("\n", $text);
        $pendingSoal = null;
        $pilihan = [];
        $jawaban = null;

        foreach ($lines as $line) {
            $line = trim($line);

            if (str_starts_with($line, '==')) {
                // Simpan soal sebelumnya jika ada
                if ($pendingSoal !== null) {
                    ExampleSoal::create([
                        'soal' => $pendingSoal,
                        'jawaban' => $jawaban,
                        'pilihan_ganda' => json_encode($pilihan),
                    ]);
                }

                // Reset untuk soal baru
                $pendingSoal = ltrim($line, '= ');
                $pilihan = [];
                $jawaban = null;
            } elseif (str_starts_with($line, '***')) {
                $textPilihan = ltrim($line, '* ');
                $pilihan[] = $textPilihan;
                $jawaban = $textPilihan;
            } elseif (str_starts_with($line, '**')) {
                $textPilihan = ltrim($line, '* ');
                $pilihan[] = $textPilihan;
            }
        }

        // Simpan soal terakhir jika belum disimpan
        if ($pendingSoal !== null) {
            ExampleSoal::create([
                'soal' => $pendingSoal,
                'jawaban' => $jawaban,
                'pilihan_ganda' => json_encode($pilihan),
            ]);
        }

        return back()->with('success', 'Soal pilihan ganda berhasil disimpan!');
    }


    public function show(Request $request)
    {
        $index = $request->session()->get('quiz_index', 0);
        $soal = ExampleSoal::skip($index)->first();

        if (!$soal) {
            // return redirect()->route('quiz.result');
            return redirect('example');
        }

        $jawabanSementara = $request->session()->get('quiz_jawaban', []);

        return view('quiz', [
            'soal' => $soal,
            'index' => $index,
            'jawaban' => $jawabanSementara[$soal->id] ?? null,
        ]);
    }

    public function submit(Request $request)
    {
        $index = $request->session()->get('quiz_index', 0);
        $soal = ExampleSoal::skip($index)->first();

        if ($soal) {
            $jawaban = $request->input('jawaban');

            // Simpan ke session
            $jawabanSementara = $request->session()->get('quiz_jawaban', []);
            $jawabanSementara[$soal->id] = $jawaban;
            $request->session()->put('quiz_jawaban', $jawabanSementara);

            // Simpan ke database hanya untuk soal aktif
            DB::table('tb_example_jawaban')->updateOrInsert(
                ['user_kode' => 'Ini Kode User', 'soal_id' => $soal->id],
                ['jawaban' => $jawaban, 'updated_at' => now()]
            );

            // Navigasi
            if ($request->has('next')) {
                $request->session()->put('quiz_index', $index + 1);
            } elseif ($request->has('prev') && $index > 0) {
                $request->session()->put('quiz_index', $index - 1);
            }
        }

        return redirect()->route('quiz.show');
    }
}
