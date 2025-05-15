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
        Schema::create('judul_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_modul_id')->constrained('sub_moduls')->onDelete('cascade');
            $table->string('judul');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judul_materi');
    }
};
