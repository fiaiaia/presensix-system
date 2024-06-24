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
        Schema::table('data_perizinan', function (Blueprint $table) {
            $table->integer('id_kelas')->change();
            $table->integer('id_wali_kelas')->change();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_perizinan', function (Blueprint $table) {
            $table->string('id_kelas');
            $table->string('id_wali_kelas');
         });
    }
};
