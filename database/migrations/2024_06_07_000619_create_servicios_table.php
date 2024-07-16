<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}

