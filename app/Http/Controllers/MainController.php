<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modul;
use App\Models\SubModul;

class MainController extends Controller
{
    public function showModul(Request $request){
        $modul = Modul::all();
        $selectedId = $request->query('selected', 1);
        $subModul = SubModul::where('modul_id', $selectedId)->get();
        $selectedModul = Modul::find($selectedId);
        return view('list_modul.index',compact('modul','subModul','selectedId','selectedModul'));
    }

    public function showMateri(){
        
    }

    public function showComunity(){
        return view('community');
    }

    public function showDashboard(){
        return view('dashboard');
    }

}
