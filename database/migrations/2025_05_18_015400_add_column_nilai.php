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
        Schema::table('user_modul_selesai', function (Blueprint $table) {
            $table->integer('nilai')->nullable()->after('tanggal_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_modul_selesai', function (Blueprint $table) {
            $table->dropColumn('nilai');
        });
    }
};