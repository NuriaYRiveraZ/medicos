<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente_citas')->constrained('pacientes');
            $table->dateTime('fecha');
            $table->float('peso')->nullable();
            $table->float('temperatura')->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->string('tension')->nullable();
            $table->float('talla')->nullable();
            $table->float('saturacion')->nullable();
            $table->text('motivo_consulta')->nullable();
            $table->string('estado_pago')->default('no pagado');
            $table->float('total_pagar')->nullable(); // Add this line for total amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
