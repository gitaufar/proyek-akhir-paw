<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('kuis');
        Schema::dropIfExists('materis');
        Schema::dropIfExists('sub_moduls');
        Schema::dropIfExists('moduls');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('sub_moduls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('judul_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_modul_id')->constrained('sub_moduls')->onDelete('cascade');
            $table->string('judul');
            $table->timestamps();
        });

        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judul_materi_id')->constrained('judul_materis')->onDelete('cascade');
            $table->string('judul');
            $table->text('isi_materi');
            $table->timestamps();
        });

        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');
            $table->json('soal');
            $table->json('jawaban');
            $table->json('opsi');
            $table->timestamps();
        });


    }
};
