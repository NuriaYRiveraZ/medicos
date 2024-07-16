<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente_pago')->constrained('pacientes');
            $table->foreignId('id_cita_pago')->constrained('citas');
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('metodo_pago', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
