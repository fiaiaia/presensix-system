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
        Schema::create('master_walikelas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_walikelas');
            $table->integer('id_kelas');
            $table->tinyInteger('is_active')->length(1); 
            $table->integer('created_by')->length(10);    
            $table->integer('updated_by')->length(10);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_walikelas');
    }
};
