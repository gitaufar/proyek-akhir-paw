<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showModul(){
        return view('list_modul');
    }

    public function showComunity(){
        return view('community');
    }
}
