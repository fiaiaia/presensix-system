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
        Schema::create('table_device', function (Blueprint $table) {
            $table->id(); 
            $table->string('device_name', 50); 
            $table->string('device_kelas', 20); 
            $table->text('device_uid'); 
            $table->date('device_date'); 
            $table->tinyInteger('device_mode'); 
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
        Schema::dropIfExists('table_device');
    }
};
