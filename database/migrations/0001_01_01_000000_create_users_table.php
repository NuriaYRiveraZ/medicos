<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('tipo', ['secretaria', 'doctor', 'paciente'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Aqui se encarga de crear dos usuarios en la BD sin necesidad de SEEDER
        $secretaria = User::create([
            'name' => 'Nuria Rivera',
            'email' => 'nuria@gmail.com',
            'password' => Hash::make('nuria21'),
            'tipo' => 'secretaria',
        ]);

        $doctor = User::create([
            'name' => 'Adrian Facundo',
            'email' => 'adrian@gmail.com',
            'password' => Hash::make('adrian21'),
            'tipo' => 'doctor',
        ]);

        $paciente = User::create([
            'name' => 'Alexa Rivera',
            'email' => 'alexa@gmail.com',
            'password' => Hash::make('alexa21'),
            'tipo' => 'paciente',
        ]);

        $paciente = User::create([
            'name' => 'Fernanda Rivera',
            'email' => 'fernanda@gmail.com',
            'password' => Hash::make('fer21'),
            'tipo' => 'paciente',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

