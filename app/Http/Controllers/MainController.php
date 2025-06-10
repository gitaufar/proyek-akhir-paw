<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Materi;
use App\Models\Tema;
use Illuminate\Http\Request;
use App\Models\Modul;
use App\Models\SubModul;
use App\Models\JudulMateri;
use App\Models\UserModulSelesai;

class MainController extends Controller
{

    public function showLevel(Request $request)
    {
        $level = Level::all();
        $selectedIdLevel = $request->query('lev', 1);
        $modul = Modul::where('level_id', $selectedIdLevel)->get();
        $userId = auth()->user()->id;
        $userModulSelesai = UserModulSelesai::where('user_id', $userId)->get();
        $selectedLevel = Level::find($selectedIdLevel);
        return view('list_modul.index', compact('userModulSelesai','level', 'modul', 'selectedIdLevel', 'selectedLevel'));
    }

    public function getTema($idSubModul)
    {
        $judulMateris = Tema::where('modul_id', $idSubModul)->get();
        return $judulMateris;
    }

    public function showMateri(Request $request)
    {
        $selectedModul = $request->query('mod');
        $selectedTema = $request->query("tem", 1);
        $selectedMateri = $request->query("mat", 3);
        $modul = Modul::find($selectedModul);
        $tema = $this->getTema($selectedModul);
        $materis = Materi::all();
        $materiDipilih = Materi::find($selectedMateri);
        return view('list_modul.materi', compact('materiDipilih', 'selectedMateri', 'tema', 'modul', 'materis', 'selectedTema'));
    }

    public function showComunity()
    {
        return view('community');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }


}
