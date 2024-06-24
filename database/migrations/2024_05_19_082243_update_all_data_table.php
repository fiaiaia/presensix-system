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
            // update
            $table->string('credential_number',24)->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('birthdate')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_data', function (Blueprint $table) {
            $table->string('credential_number');
            $table->string('name');
            $table->string('birthdate');
            $table->string('status');
        });
    }
};
