<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente_expedientes')->constrained('pacientes');
            $table->date('fecha');
            $table->text('seguimiento')->nullable();
            $table->string('archivos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('expedientes');
    }
}
