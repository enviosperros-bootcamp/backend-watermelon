<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('patients', function (Blueprint $table) {
    $table->id();  // agrega esta línea para crear columna 'id' primaria autoincremental
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('email')->unique();
    $table->string('sex')->nullable();
    $table->date('birth_date')->nullable();
    $table->integer('age')->nullable();
    $table->string('occupation')->nullable();
    $table->string('phone')->nullable();
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
