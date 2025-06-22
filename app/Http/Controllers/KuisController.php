<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\PilihanJawaban;
use Illuminate\Http\Request;
use App\Models\Kuis;
use App\Models\UserKuis;
use App\Models\UserModulSelesai;

class KuisController extends Controller
{
    public function showKuis(Request $request)
    {
        $modulId = $request->query('mod');
        $soalKuis = Kuis::where('modul_id', $modulId)->get();
        $jawaban = PilihanJawaban::where('kuis_id', $soalKuis[0]->id)->get();
        $modul = Modul::find($modulId);
        $userId = auth()->user()->id;

        return view('kuis', compact('soalKuis', 'modul', 'userId', 'jawaban'));
    }

    public function getJawaban($idKuis)
    {
        $jawaban = PilihanJawaban::where('kuis_id', $idKuis)->get();
        return response()->json($jawaban);
    }

    public function postJawaban(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'idKuis' => 'required|integer',
            'idUser' => 'required|integer',
            'isBenar' => 'required|boolean',
            'jawaban' => 'required|string',
        ]);

        // Cek apakah sudah ada jawaban user untuk kuis tersebut
        $jawaban = UserKuis::where('kuis_id', $validated['idKuis'])
            ->where('user_id', $validated['idUser'])
            ->first();

        if ($jawaban) {
            // Jika sudah ada, update
            $jawaban->is_benar = $validated['isBenar'];
            $jawaban->jawaban_user = $validated['jawaban'];
            $jawaban->save();

            $message = 'Jawaban berhasil diperbarui';
        } else {
            // Jika belum ada, buat baru
            $jawaban = new UserKuis();
            $jawaban->kuis_id = $validated['idKuis'];
            $jawaban->user_id = $validated['idUser'];
            $jawaban->is_benar = $validated['isBenar'];
            $jawaban->jawaban_user = $validated['jawaban'];
            $jawaban->save();

            $message = 'Jawaban berhasil disimpan';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }

    public function postQuizSelesai(Request $request)
    {
        $validated = $request->validate([
            'idUser' => 'required|integer',
            'idModul' => 'required|integer',
            'nilai' => 'required|integer',
        ]);

        $userModulSelesai = UserModulSelesai::where('user_id', $validated['idUser'])
            ->where('modul_id', $validated['idModul'])
            ->first();

        if (!$userModulSelesai) {
            // Jika belum ada, insert data baru
            $userModulSelesai = new UserModulSelesai();
            $userModulSelesai->user_id = $validated['idUser'];
            $userModulSelesai->modul_id = $validated['idModul'];
            $userModulSelesai->tanggal_selesai = now()->toDateTimeString();
            $userModulSelesai->nilai = $validated['nilai'];
            $userModulSelesai->save();
            $message = 'Modul selesai berhasil disimpan';
        } else {
            // Jika sudah ada, update nilai saja
            $userModulSelesai->nilai = $validated['nilai'];
            $userModulSelesai->save();
            $message = 'Nilai berhasil diperbarui';
        }

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }


    public function getAkurasi($modulId)
    {
        $idUser = auth()->user()->id;

        $kuisIds = Kuis::where('modul_id', $modulId)->pluck('id');

        $jawabanBenar = UserKuis::where('user_id', $idUser)
            ->whereIn('kuis_id', $kuisIds)
            ->get();

        return response()->json($jawabanBenar);
    }

}
