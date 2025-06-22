<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Materi;
use App\Models\Tema;
use Illuminate\Http\Request;
use App\Models\Modul;
use App\Models\UserModulSelesai;
use App\Models\Post;

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
        return view('list_modul.index', compact('userModulSelesai', 'level', 'modul', 'selectedIdLevel', 'selectedLevel'));
    }

    public function getTema($idSubModul)
    {
        $judulMateris = Tema::where('modul_id', $idSubModul)->get();
        return $judulMateris;
    }

    public function showMateri(Request $request)
    {
        $selectedModul = $request->query('mod');
        $selectedMateri = $request->query('mat');
        $selectedTema = $request->query("tem", 1);

        $modul = Modul::find($selectedModul);
        $tema = $this->getTema($selectedModul);
        $materis = Materi::all();

        if (!$selectedMateri) {
            // Ambil materi pertama dari tema pertama
            $materiDipilih = Materi::where('tema_id', $tema[0]->id)->first();
        } else {
            // Ambil materi berdasarkan ID
            $materiDipilih = Materi::find($selectedMateri);
        }
        return view('list_modul.materi', compact('materiDipilih', 'tema', 'modul', 'materis', 'selectedTema'));
    }


    public function showComunity()
    {
        $posts = Post::with(['author', 'likes', 'comments'])->latest()->get();
        $posts->transform(function ($post) {
            $post->formatted_timestamp = $post->created_at->format('d M Y, H:i');
            return $post;
        });
        $userId = auth()->user()->id;
        return view('community', compact('posts', 'userId'));
    }

    public function showDashboard()
    {
        return view('dashboard');
    }


}
