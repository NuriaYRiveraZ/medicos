<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = [
            ['nombre' => 'Consulta General', 'precio' => 200.00],
            ['nombre' => 'Radiografías', 'precio' => 800.00],
            ['nombre' => 'Consulta Especializada', 'precio' => 700.00],
            ['nombre' => 'Ecografía', 'precio' => 1000.00],
            ['nombre' => 'Exámenes de Laboratorio', 'precio' => 600.00],
            ['nombre' => 'Resonancia Magnética', 'precio' => 1200.00],
            ['nombre' => 'Tomografía Computarizada', 'precio' => 1100.00],
            ['nombre' => 'Endoscopia', 'precio' => 850.00],
            ['nombre' => 'Electrocardiograma', 'precio' => 400.00],
            ['nombre' => 'Colonoscopia', 'precio' => 950.00],
            ['nombre' => 'Densitometría Ósea', 'precio' => 850.00],
            ['nombre' => 'Cirugía Menor', 'precio' => 1500.00],
            ['nombre' => 'Mamografía', 'precio' => 700.00],
            ['nombre' => 'Psicoterapia', 'precio' => 600.00],
            ['nombre' => 'Fisioterapia', 'precio' => 550.00],
            ['nombre' => 'Odontología Preventiva', 'precio' => 450.00],
            ['nombre' => 'Consulta Nutricional', 'precio' => 500.00],
            ['nombre' => 'Terapia Ocupacional', 'precio' => 650.00],
            ['nombre' => 'Test de Audiometría', 'precio' => 300.00],
            ['nombre' => 'Pruebas de Alergia', 'precio' => 400.00],
            ['nombre' => 'Estudios de Sueño', 'precio' => 900.00],
            ['nombre' => 'Rehabilitación Cardíaca', 'precio' => 850.00],
            ['nombre' => 'Consulta Geriátrica', 'precio' => 550.00],
            ['nombre' => 'Podología', 'precio' => 400.00],
            ['nombre' => 'Consulta Dermatológica', 'precio' => 600.00],
            ['nombre' => 'Consulta Ginecológica', 'precio' => 700.00],
            ['nombre' => 'Terapia Respiratoria', 'precio' => 500.00],
            ['nombre' => 'Consulta Pediátrica', 'precio' => 550.00],
            ['nombre' => 'Consulta Oncológica', 'precio' => 1000.00],
            ['nombre' => 'Biopsia', 'precio' => 1200.00],
        ];

        DB::table('servicios')->insert($servicios);
    }
}
