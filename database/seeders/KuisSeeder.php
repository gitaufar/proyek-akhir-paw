<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kuis;
use App\Models\PilihanJawaban;

class KuisSeeder extends Seeder
{
    public function run(): void
    {
        $kuisList = [
            [
                'pertanyaan' => 'Apa perbedaan utama antara wirausahawan dan pedagang?',
                'jawaban' => [
                    ['teks' => 'Wirausahawan menciptakan nilai baru dan inovatif, sedangkan pedagang fokus menjual barang yang sudah ada.', 'benar' => true],
                    ['teks' => 'Pedagang lebih sukses dibandingkan wirausahawan.', 'benar' => false],
                    ['teks' => 'Wirausahawan tidak mengambil risiko, sedangkan pedagang mengambil banyak risiko.', 'benar' => false],
                    ['teks' => 'Pedagang selalu menciptakan inovasi baru.', 'benar' => false],
                ],
            ],
            [
                'pertanyaan' => 'Berikut ini merupakan ciri-ciri wirausahawan sukses, kecuali?',
                'jawaban' => [
                    ['teks' => 'Berani mengambil risiko.', 'benar' => false],
                    ['teks' => 'Kreatif dan inovatif.', 'benar' => false],
                    ['teks' => 'Menyerah saat gagal.', 'benar' => true],
                    ['teks' => 'Mampu melihat peluang.', 'benar' => false],
                ],
            ],
            [
                'pertanyaan' => 'Mengapa wirausaha sangat penting dalam era ekonomi digital saat ini?',
                'jawaban' => [
                    ['teks' => 'Karena menciptakan lapangan kerja baru dan solusi inovatif.', 'benar' => true],
                    ['teks' => 'Karena semua bisnis digital pasti sukses.', 'benar' => false],
                    ['teks' => 'Karena ekonomi digital tidak membutuhkan inovasi.', 'benar' => false],
                    ['teks' => 'Karena semua orang harus menjadi wirausahawan.', 'benar' => false],
                ],
            ],
            [
                'pertanyaan' => 'Apa perbedaan utama antara growth mindset dan fixed mindset?',
                'jawaban' => [
                    ['teks' => 'Growth mindset percaya kemampuan bisa dikembangkan, fixed mindset percaya kemampuan tetap.', 'benar' => true],
                    ['teks' => 'Growth mindset berarti malas belajar.', 'benar' => false],
                    ['teks' => 'Fixed mindset selalu berpikir positif.', 'benar' => false],
                    ['teks' => 'Growth mindset tidak cocok dalam dunia wirausaha.', 'benar' => false],
                ],
            ],
            [
                'pertanyaan' => 'Mengapa penting bagi wirausahawan untuk belajar dari kegagalan?',
                'jawaban' => [
                    ['teks' => 'Agar tidak mengulangi kesalahan dan bisa berinovasi lebih baik.', 'benar' => true],
                    ['teks' => 'Agar bisa menyalahkan orang lain atas kegagalan.', 'benar' => false],
                    ['teks' => 'Karena kegagalan tidak bisa dihindari dan harus diterima saja.', 'benar' => false],
                    ['teks' => 'Karena inovasi tidak diperlukan dalam wirausaha.', 'benar' => false],
                ],
            ],
        ];

        foreach ($kuisList as $index => $kuisData) {
            $kuis = Kuis::create([
                'modul_id' => 1,
                'nomor_kuis' => $index + 1,
                'pertanyaan' => $kuisData['pertanyaan'],
            ]);

            foreach ($kuisData['jawaban'] as $jawaban) {
                PilihanJawaban::create([
                    'kuis_id' => $kuis->id,
                    'teks_pilihan' => $jawaban['teks'],
                    'is_benar' => $jawaban['benar'],
                ]);
            }
        }
    }
}
