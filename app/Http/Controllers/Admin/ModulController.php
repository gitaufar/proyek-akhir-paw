<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\Tema;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::with('level', 'user')->latest()->get();
        return view('admin.modul.index', compact('moduls'));
    }

    public function create()
    {
        return view('admin.modul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_modul' => 'required|string',
            'submoduls' => 'required|array',
            'submoduls.*.judul_tema' => 'required|string',
            'submoduls.*.materis' => 'required|array',
            'submoduls.*.materis.*.judul_materi' => 'required|string',
            'submoduls.*.materis.*.konten' => 'required|string',
        ]);

        $modul = Modul::create([
            'level_id' => 1,
            'nama_modul' => $request->nama_modul,
            'created_by' => Auth::id(),
            'deskripsi' => 'kocak',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($request->submoduls as $submodul) {
            $tema = Tema::create([
                'modul_id' => $modul->id,
                'judul_tema' => $submodul['judul_tema'],
                'created_at' => now(),
                'updated_at' => now()
                
            ]);

            
            foreach ($submodul['materis'] as $materi) {
                Materi::create([
                    'tema_id' => $tema->id,
                    'judul_materi' => $materi['judul_materi'],
                    'konten' => $materi['konten'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
        }
        
        return redirect()->route('modul.index')->with('success', 'Modul berhasil dibuat');
    }

    public function destroy($id)
    {
        $modul = Modul::findOrFail($id);
        $modul->delete();
        return back()->with('success', 'Modul berhasil dihapus');
    }

    // (opsional) Tambahkan edit & update jika dibutuhkan
}
