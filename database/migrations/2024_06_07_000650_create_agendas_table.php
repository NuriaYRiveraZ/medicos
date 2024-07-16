<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente_agenda')->constrained('pacientes');
            $table->date('fecha');
            $table->time('hora');
            $table->string('telefono', 20)->nullable();
            $table->boolean('atendida')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
}
