<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicamentos = [
            ['nombre' => 'Paracetamol', 'tipo' => 'Medicamento', 'precio' => 15.50, 'cantidad' => 100],
            ['nombre' => 'Ibuprofeno', 'tipo' => 'Medicamento', 'precio' => 20.75, 'cantidad' => 80],
            ['nombre' => 'Aspirina', 'tipo' => 'Medicamento', 'precio' => 12.30, 'cantidad' => 150],
            ['nombre' => 'Antidiarreico', 'tipo' => 'Medicamento', 'precio' => 18.75, 'cantidad' => 70],
            ['nombre' => 'Acetaminofén', 'tipo' => 'Medicamento', 'precio' => 10.25, 'cantidad' => 110],
            ['nombre' => 'Antigripal', 'tipo' => 'Medicamento', 'precio' => 22.00, 'cantidad' => 60],
            ['nombre' => 'Analgésico en gel', 'tipo' => 'Medicamento', 'precio' => 15.00, 'cantidad' => 85],
            ['nombre' => 'Pastillas para la garganta', 'tipo' => 'Medicamento', 'precio' => 14.20, 'cantidad' => 95],
            ['nombre' => 'Jarabe para la tos', 'tipo' => 'Medicamento', 'precio' => 18.50, 'cantidad' => 75],
            ['nombre' => 'Antihistamínico', 'tipo' => 'Medicamento', 'precio' => 17.90, 'cantidad' => 65],
        ];

        // Insertar los medicamentos en la base de datos
        DB::table('medicamentos')->insert($medicamentos);
    }
}
