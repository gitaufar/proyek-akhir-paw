<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\PilihanJawaban;
use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\UserKuis;

class KuisController extends Controller
{
    public function showKuis(Request $request)
    {
        $modulId = $request->query('mod');
        $soalKuis = Kuis::where('modul_id', $modulId)->get();
        $modul = Modul::find($modulId);
        $userId = auth()->user()->id;

        return view('kuis', compact('soalKuis', 'modul', 'userId'));
    }

    public function getJawaban($idKuis)
    {
        $jawaban = PilihanJawaban::where('kuis_id', $idKuis)->get();
        return response()->json($jawaban);
    }

    public function postJawaban(Request $request)
    {
        // Validasi data jika perlu
        $validated = $request->validate([
            'idKuis' => 'required|integer',
            'idUser' => 'required|integer',
            'isBenar' => 'required|boolean',
            'jawaban' => 'required|string',
        ]);

        $jawaban = new UserKuis();
        $jawaban->kuis_id = $validated['idKuis'];
        $jawaban->user_id = $validated['idUser'];
        $jawaban->is_benar = $validated['isBenar'];
        $jawaban->jawaban_user = $validated['jawaban'];
        $jawaban->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Jawaban berhasil disimpan'
        ]);
    }

}
