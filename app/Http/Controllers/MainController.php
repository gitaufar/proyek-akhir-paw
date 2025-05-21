<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use App\Models\Modul;
use App\Models\SubModul;
use App\Models\JudulMateri;

class MainController extends Controller
{

    public function showModul(Request $request){
        $modul = Modul::all();
        $selectedId = $request->query('selectedModul', 1);
        $subModul = SubModul::where('modul_id', $selectedId)->get();
        $selectedModul = Modul::find($selectedId);
        return view('list_modul.index',compact('modul','subModul','selectedId','selectedModul'));
    }

    public function getJudulMateris($idSubModul) {
        $judulMateris = JudulMateri::where('sub_modul_id', $idSubModul)->get();
        return $judulMateris;
    }

    public function showMateri(Request $request){
        $selectedSubModul = $request->query('selectedSub', 1);
        $selectedJudulMateri = $request->query("selectedJudulMateri", 1);
        $subModul = SubModul::find($selectedSubModul);
        $judulMateris = $this->getJudulMateris($selectedSubModul);
        $materis = $this->getMateris($selectedJudulMateri);
        return view('list_modul.materi',compact('judulMateris','subModul','materis','selectedJudulMateri'));
    }

    public function getMateris($idJudulMateri) {
        $materis = Materi::where('judul_materi_id', $idJudulMateri)->get();
        return $materis;
    }

    public function showComunity(){
        return view('community');
    }

    public function showDashboard(){
        return view('dashboard');
    }

}
