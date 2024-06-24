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
        Schema::create('all_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('credential_number',24);
            $table->string('name');
            $table->string('class')->nullable();
            $table->string('position')->nullable();
            $table->string('birthdate');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_data');
    }
};
