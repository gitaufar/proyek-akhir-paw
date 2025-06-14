<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judul = [
            'Definisi wirausaha dan perbedaannya dengan pedagang.',
            'Ciri-ciri wirausahawan sukses.',
            'Kenapa wirausaha penting dalam ekonomi digital saat ini.',
            'Growth mindset vs fixed mindset.',
            'Belajar dari kegagalan dan pentingnya inovasi.',
            'Video rangkuman.',
            'Kuis.'
        ];

        $isimateri = [
            '<h1>Definisi wirausaha dan perbedaannya dengan pedagang.</h1><br>Wirausaha adalah proses mengidentifikasi peluang usaha, menciptakan inovasi, serta mengelola sumber daya untuk menciptakan suatu produk atau jasa yang memberikan nilai tambah dan menghasilkan keuntungan. Seorang wirausahawan (entrepreneur) tidak hanya menjalankan usaha, tetapi membangun dan mengembangkan sesuatu yang baru baik dalam bentuk produk, model bisnis, maupun cara menyelesaikan masalah masyarakat.
<br><h1>Definisi Pedagang</h1><br>Pedagang adalah seseorang yang melakukan aktivitas jual beli barang atau jasa untuk mendapatkan keuntungan. Fokus utama pedagang adalah membeli produk dari pihak lain dan menjualnya kembali tanpa mengubah bentuk atau nilai tambah yang signifikan.',
            '',
            '',
            '',
            '',
            '',
            '<p id="kuis-text">Selamat! Anda telah menyelesaikan modul ini, Untuk menguji
kemampuan anda silahkan kerjakan kuis dengan memencet
tombol dibawah ini! (kuis bisa dikerjakan 1 kali setiap harinya)</p>
<div class="flex justify-center w-full"><button id="btn-kuis" class="text-base font-semibold">
Mulai Kuis</button></div>'

        ];

        for ($i = 0; $i < count($judul); $i++) {
            $id = 0;
            if ($i < 3) {
                $id++;
            } else if ($i < 5) {
                $id += 2;
            } else if ($i < 6) {
                $id += 3;
            } else {
                $id += 4;
            }
            Materi::create(['tema_id' => $id, 'judul_materi' => $judul[$i], 'konten' => $isimateri[$i], 'created_at' => now(), 'updated_at' => now()]);
        }

    }
}
