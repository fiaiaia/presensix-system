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
        Schema::table('user_log', function (Blueprint $table) {
            $table->integer('fingerprint_id')->nullable()->change();
            $table->string('device_uid', 20)->nullable()->change();
            $table->string('device_kelas', 20)->nullable()->change();
            $table->time('timein')->nullable()->change();
            $table->time('timeout')->nullable()->change();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_log', function (Blueprint $table) {
            $table->integer('fingerprint_id');
            $table->string('device_uid');
            $table->string('device_kelas');
            $table->time('timein');
            $table->time('timeout');
         });
    }
};
