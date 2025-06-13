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
    public function index(Request $request)
    {
        $query = Modul::with('level', 'user');

        if ($request->has('search') && $request->search !== null) {
            $query->where('nama_modul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('level')) {
            $query->where('level_id', $request->level);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
            case 'nama_modul':
                $query->orderByRaw('LOWER(nama_modul) asc');
                break;
            case 'level_id':
                $query->orderBy('level_id');
                break;
            case 'created_by':
                $query->orderBy('created_by');
                break;
            case 'updated_at':
                $query->orderByDesc('updated_at');
                break;
        }

        } else {
            $query->latest();
        }

        $moduls = $query->get();

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
            'kuis' => 'nullable|array',
            'kuis.*.pertanyaan' => 'nullable|string',
            'kuis.*.opsi_a' => 'nullable|string',
            'kuis.*.opsi_b' => 'nullable|string',
            'kuis.*.opsi_c' => 'nullable|string',
            'kuis.*.opsi_d' => 'nullable|string',
            'kuis.*.jawaban' => 'nullable|in:A,B,C,D',

        ]);

        $modul = Modul::create([
            'level_id' => $request->level_id,
            'nama_modul' => $request->nama_modul,
            'created_by' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!empty($request->kuis) && is_array($request->kuis)) {
            foreach ($request->kuis as $index => $kuisData) {
                if (!empty($kuisData['pertanyaan'])) {
                    $kuis = \App\Models\Kuis::create([
                        'modul_id' => $modul->id,
                        'pertanyaan' => $kuisData['pertanyaan'],
                        'nomor_kuis' => $index + 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // Simpan pilihan jawaban
                    $opsi = ['A' => 'opsi_a', 'B' => 'opsi_b', 'C' => 'opsi_c', 'D' => 'opsi_d'];
                    foreach ($opsi as $key => $field) {
                        if (!empty($kuisData[$field])) {
                            \App\Models\PilihanJawaban::create([
                                'kuis_id' => $kuis->id,
                                'teks_pilihan' => $kuisData[$field],
                                'is_benar' => ($key === $kuisData['jawaban']) ? 1 : 0,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }
        }


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

    
    public function edit($id)
    {
        $modul = Modul::with('temas.materis')->findOrFail($id);

        // Ambil semua kuis milik modul ini
        $kuis = \App\Models\Kuis::where('modul_id', $modul->id)->with('pilihanJawaban')->get();

        // Format data kuis agar mudah diisi ulang ke form
        $kuis_formatted = $kuis->map(function ($item) {
            $opsi = [];
            foreach ($item->pilihanJawaban as $pilihan) {
                if ($pilihan->is_benar) {
                    $item->jawaban = array_search($pilihan->teks_pilihan, [
                        'A' => $pilihan->teks_pilihan,
                        'B' => $pilihan->teks_pilihan,
                        'C' => $pilihan->teks_pilihan,
                        'D' => $pilihan->teks_pilihan,
                    ]);
                }

                // Asumsikan urutan input opsi adalah A, B, C, D (urutan tetap)
                if (!isset($opsi['A'])) $opsi['A'] = $pilihan->teks_pilihan;
                elseif (!isset($opsi['B'])) $opsi['B'] = $pilihan->teks_pilihan;
                elseif (!isset($opsi['C'])) $opsi['C'] = $pilihan->teks_pilihan;
                elseif (!isset($opsi['D'])) $opsi['D'] = $pilihan->teks_pilihan;
            }

            $item->opsi = $opsi;
            return $item;
        });

        return view('admin.modul.edit', compact('modul', 'kuis_formatted'))->with(['kuis' => $kuis_formatted]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_modul' => 'required|string',
            'submoduls' => 'required|array',
            'submoduls.*.judul_tema' => 'required|string',
            'submoduls.*.materis' => 'required|array',
            'submoduls.*.materis.*.judul_materi' => 'required|string',
            'submoduls.*.materis.*.konten' => 'required|string',
            'kuis' => 'nullable|array',
            'kuis.*.pertanyaan' => 'nullable|string',
            'kuis.*.opsi_a' => 'nullable|string',
            'kuis.*.opsi_b' => 'nullable|string',
            'kuis.*.opsi_c' => 'nullable|string',
            'kuis.*.opsi_d' => 'nullable|string',
            'kuis.*.jawaban' => 'nullable|in:A,B,C,D',
        ]);


        $modul = Modul::findOrFail($id);
        $modul->update([
            'nama_modul' => $request->nama_modul,
            'deskripsi' => $request->deskripsi,
            'level_id' => $request->level_id,
            'updated_at' => now()
        ]);


        // Hapus semua tema & materi lama
        foreach ($modul->temas as $tema) {
            $tema->materis()->delete();
            $tema->delete();
        }

        // Buat ulang tema & materi
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

        // Hapus kuis lama
        \App\Models\Kuis::where('modul_id', $modul->id)->each(function ($kuis) {
            $kuis->pilihanJawaban()->delete();
            $kuis->delete();
        });

        // Simpan kuis baru
        $nomor = 1;
        if (!empty($request->kuis) && is_array($request->kuis)) {
            foreach ($request->kuis as $index => $kuisData) {
                if (!empty($kuisData['pertanyaan'])) {
                    $kuis = \App\Models\Kuis::create([
                        'modul_id' => $modul->id,
                        'pertanyaan' => $kuisData['pertanyaan'],
                        'nomor_kuis' => $nomor++,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // Simpan pilihan jawaban
                    $opsi = ['A' => 'opsi_a', 'B' => 'opsi_b', 'C' => 'opsi_c', 'D' => 'opsi_d'];
                    foreach ($opsi as $key => $field) {
                        if (!empty($kuisData[$field])) {
                            \App\Models\PilihanJawaban::create([
                                'kuis_id' => $kuis->id,
                                'teks_pilihan' => $kuisData[$field],
                                'is_benar' => ($key === $kuisData['jawaban']) ? 1 : 0,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }
        }



        return redirect()->route('modul.index')->with('success', 'Modul berhasil diperbarui');
    }

}
