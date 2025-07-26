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
    Schema::create('historial_e_d_s', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('patient_id');
        $table->date('date');
        $table->text('summary');
        $table->string('doctor')->nullable();
        $table->timestamps();

        $table->foreign('patient_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_e_d_s');
    }
};
