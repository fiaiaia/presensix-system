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
        Schema::create('data_perizinan_logs', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->integer('ticket_id')->length(10);  
            $table->string('status')->length(20);    
            $table->text('description');  
            $table->tinyInteger('is_active')->length(1);
            $table->integer('created_by')->length(10);    
            $table->integer('updated_by')->length(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_perizinan_logs');
    }
};
