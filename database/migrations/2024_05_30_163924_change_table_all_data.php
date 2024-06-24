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
            $table->string('device_id')->default(0)->nullable()->change();
            $table->integer('fingerprint_id')->nullable()->change();
            $table->boolean('fingerprint_select')->default(false)->nullable()->change();
            $table->boolean('del_fingerid')->default(false)->nullable()->change();
            $table->boolean('add_fingerid')->default(false)->nullable()->change();
            $table->string('device_kelas',20)->nullable()->change();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_data', function (Blueprint $table) {
            $table->string('device_id');
            $table->string('fingerprint_id');
            $table->string('fingerprint_select');
            $table->string('del_fingerid');
            $table->string('add_fingerid');
            $table->string('device_kelas');
        });
    }
};
