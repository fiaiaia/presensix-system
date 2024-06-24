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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('fingerprint_id')->nullable()->unique();
            $table->boolean('add_fingerid')->default(false)->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->string('nama_ortu_siswa',64)->nullable();
            $table->string('no_telp_ortu', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fingerprint_id']);
            $table->dropColumn(['add_fingerid']);
            $table->dropColumn(['no_telp']);
            $table->dropColumn(['nama_ortu_siswa']);
            $table->dropColumn(['no_telp_ortu']);
        });
    }
};
