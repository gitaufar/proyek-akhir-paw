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
            'Definisi wirausaha dan perbedaannya dengan pedagang. '
        ];

        $isimateri = [
            '<h1>Definisi wirausaha dan perbedaannya dengan pedagang.<h1> Wirausaha adalah proses mengidentifikasi peluang usaha, menciptakan inovasi, serta mengelola sumber daya untuk menciptakan suatu produk atau jasa yang memberikan nilai tambah dan menghasilkan keuntungan. Seorang wirausahawan (entrepreneur) tidak hanya menjalankan usaha, tetapi membangun dan mengembangkan sesuatu yang baru — baik dalam bentuk produk, model bisnis, maupun cara menyelesaikan masalah masyarakat. <h1>Definisi Pedagang<h1> Pedagang adalah seseorang yang melakukan aktivitas jual beli barang atau jasa untuk mendapatkan keuntungan. Fokus utama pedagang adalah membeli produk dari pihak lain dan menjualnya kembali tanpa mengubah bentuk atau nilai tambah yang signifikan.'
        ];

        for ($i = 0; $i < count($judul); $i++) {
            Materi::create(['judul_materi_id' => 1, 'judul' => $judul[$i],'isi_materi' => $isimateri[$i],'created_at' => now(),'updated_at' => now()]);
        }

    }
}
