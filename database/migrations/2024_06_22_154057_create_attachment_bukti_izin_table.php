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
        Schema::create('attachment_bukti_izin', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->integer('ticket_id')->length(10)->nullable();
            $table->string('name')->length(100);
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
        Schema::dropIfExists('attachment_bukti_izin');
    }
};
