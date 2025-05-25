<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_level');
            $table->timestamps();
        });

        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->string('nama_modul');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->string('judul_tema');
            $table->timestamps();
        });

        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tema_id')->constrained('temas')->onDelete('cascade');
            $table->string('judul_materi');
            $table->text('konten');
            $table->timestamps();
        });

        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->integer('nomor_kuis');
            $table->text('pertanyaan');
            $table->timestamps();
        });

        Schema::create('pilihan_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');
            $table->string('teks_pilihan');
            $table->boolean('is_benar')->default(false);
            $table->timestamps();
        });

        Schema::create('user_kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');
            $table->string('jawaban_user');
            $table->boolean('is_benar');
            $table->timestamps();
        });

        Schema::create('user_modul_selesai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->timestamp('tanggal_selesai')->useCurrent();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('levels');
        Schema::dropIfExists('moduls');
        Schema::dropIfExists('temas');
        Schema::dropIfExists('materis');
        Schema::dropIfExists('kuis');
        Schema::dropIfExists('pilihan_jawabans');
        Schema::dropIfExists('user_kuis');
        Schema::dropIfExists('user_modul_selesai');
        Schema::enableForeignKeyConstraints();
    }
};
