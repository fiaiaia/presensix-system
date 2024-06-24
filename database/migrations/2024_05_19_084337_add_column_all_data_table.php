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
        Schema::table('all_data', function (Blueprint $table) {
           // add new
           $table->string('no_telp', 15)->nullable();
           $table->string('nama_ortu_siswa',64)->nullable();
           $table->string('no_telp_ortu', 15)->nullable();
           $table->string('device_id')->default(0);
           $table->integer('fingerprint_id');
           $table->boolean('fingerprint_select')->default(false);
           $table->boolean('del_fingerid')->default(false);
           $table->boolean('add_fingerid')->default(false);
           $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_data', function (Blueprint $table) {
            $table->dropColumn(['no_telp']);
            $table->dropColumn(['nama_ortu_siswa']);
            $table->dropColumn(['no_telp_ortu']);
            $table->dropColumn(['device_id']);
            $table->dropColumn(['fingerprint_id']);
            $table->dropColumn(['fingerprint_select']);
            $table->dropColumn(['del_fingerid']);
            $table->dropColumn(['add_fingerid']);
            $table->dropColumn(['deleted_at']);
         });
    }
};
