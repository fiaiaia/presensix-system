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
            $table->string('jenis_kelamin', 20);
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_data', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin']);
         });
    }
};
