<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDoctorIdNullableInAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable(false)->change();
        });
    }
}
