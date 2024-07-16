<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = [
            [
                'nombre_completo' => 'Juan Perez',
                'fecha_nacimiento' => '1980-05-12',
                'genero' => 'Masculino',
                'telefono' => '555-1234',
            ],
            [
                'nombre_completo' => 'Maria Rodriguez',
                'fecha_nacimiento' => '1992-08-21',
                'genero' => 'Femenino',
                'telefono' => '555-5678',
            ],
            [
                'nombre_completo' => 'Carlos Lopez',
                'fecha_nacimiento' => '1975-11-30',
                'genero' => 'Masculino',
                'telefono' => '555-8765',
            ],
            [
                'nombre_completo' => 'Ana Gomez',
                'fecha_nacimiento' => '2000-01-15',
                'genero' => 'Femenino',
                'telefono' => '555-4321',
            ],
        ];

        foreach ($pacientes as $paciente) {
            Patient::create($paciente);
        }
    }
}
