<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $data = Quiz::all();
        $diffInMinutes = 0;

        foreach ($data as $quiz) {
            $start = Carbon::parse($quiz->start)->format('Y-m-d H:i:s');
            $end = Carbon::parse($quiz->date)->format('Y-m-d H:i:s');
            
            // hitung selesih waktu
            $diffInMinutes += Carbon::parse($end)->diffInMinutes(Carbon::parse($start));
        }

        // return $diffInMinutes;
        
        return view('quiz.quiz', compact('diffInMinutes'));
    }




    public function QuizSelesai()
    {
        // update permission
        $status = "is_deactive";

        Quiz::where('id', '1')->update([
            'status' => $status
        ]);

        return view('quiz.quiz-selesai');
    }


    public function QuizStart()
    {
        return view('quiz.quiz-start');
    }




    public function QuizCheck(Request $request)
    {
        $data = Quiz::find(1); // Menggunakan find(1) untuk mencari quiz dengan ID 1
        
        if ($data && $data->kode == $request->start) {
            return redirect('test-calon-karyawan-ksb')->with('status', 'KODE BENAR!');
        } else {
            return redirect('test-start')->with('status', 'KODE SALAH!');
        }
    }





    public function view()
    {
        $data = Quiz::all();
        $diffInMinutes = 0;
        foreach ($data as $quiz) {
            $start = Carbon::parse($quiz->start)->format('Y-m-d H:i:s');
            $end = Carbon::parse($quiz->date)->format('Y-m-d H:i:s');
            
            // hitung selesih waktu
            $diffInMinutes += Carbon::parse($end)->diffInMinutes(Carbon::parse($start));
        }
        return view('quiz.index-admin', compact('data', 'diffInMinutes'), [ 'tittle' => "Test Psikolog" ]);
    }



    public function edit($id)
    {
        $data = Quiz::where('id', $id)->first();
        return view('quiz.edit-admin', compact('data'), [ 'tittle' => "Test Psikolog Edit" ]);
    }



    public function update(Request $request, $id)
    {
        $start = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', request('start'));
        $end = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', request('end'));

        // return $start;
        Quiz::where('id', '1')->update([
            'kode' => $request->kode,
            'status' => $request->status,
            'start' => $start,
            'date' => $end
        ]);

        return redirect('test-admin')->with('status', 'DATA TEST ONLINE BERHASIL DIUBAH!');
    }

}
