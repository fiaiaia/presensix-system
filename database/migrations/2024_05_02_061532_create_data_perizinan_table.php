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
        Schema::create('data_perizinan', function (Blueprint $table) {
            $table->increments('id')->length(10);
            $table->string('kode_izin')->length(20);
            $table->string('id_kelas')->length(20);
            $table->string('id_wali_kelas')->length(50);
            $table->datetime('waktu_izin');
            $table->string('status_izin')->length(30);
            $table->text('description');
            $table->string('status_dokumen')->length(20);
            $table->string('approval_walikelas')->length(36)->nullable();
            $table->string('approval_guru_bk')->length(36)->nullable();
            $table->timestamp('approval_date_walikelas')->nullable();
            $table->timestamp('approval_date_guru_bk')->nullable();
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
        Schema::dropIfExists('data_perizinan');
    }
};
