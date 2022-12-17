<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asignatura_id');
            $table->unsignedBigInteger('profesor_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('asignatura_id')->references('id')->on('asignatura');
            $table->foreign('profesor_id')->references('id')->on('profesor');
            $table->foreign('estudiante_id')->references('id')->on('estudiante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_estudiante');
    }
};
