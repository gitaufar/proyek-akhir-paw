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
        
        Schema::dropIfExists('materis');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judul_materi_id')->constrained('judul_materis')->onDelete('cascade');
            $table->string('judul');
            $table->text('isi_materi');
            $table->timestamps();
        });
    }
};
