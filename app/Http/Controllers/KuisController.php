<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function showKuis(Request $request){
        return view('kuis', compact('request'));
    }
}
