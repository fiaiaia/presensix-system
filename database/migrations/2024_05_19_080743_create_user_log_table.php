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
        Schema::create('user_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->double('credential_number');
            $table->integer('fingerprint_id');
            $table->string('device_uid', 20);
            $table->string('device_kelas', 20);
            $table->date('checkindate');
            $table->time('timein');
            $table->time('timeout');
            $table->boolean('fingerout')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_log');
    }
};
