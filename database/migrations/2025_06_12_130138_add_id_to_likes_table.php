<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            // Hapus foreign key constraint jika ada
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);

            // Hapus primary key composite
            $table->dropPrimary(['user_id', 'post_id']);

            // Tambahkan kolom id sebagai primary key baru
            $table->id()->first();
        });
    }


    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(['user_id', 'post_id']);
        });
    }
};
