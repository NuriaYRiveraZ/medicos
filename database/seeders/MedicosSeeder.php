<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;
use App\Models\Patient;
use App\Models\User;
use App\Models\Producto;

class MedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $usuarioMedico = User::where('tipo', 'doctor')->first();
        if ($usuarioMedico) {
            Medico::create([
                'nombre' => 'Adrian Perez',
                'telefono' => '8341209557',
                'profesion' => 'Medico General',
                'tipo' => 'Base',
                'id_usuario_medicos' => $usuarioMedico->id,
            ]);
        }

        $usuarioPaciente = User::where('tipo', 'paciente')->first();
        if ($usuarioPaciente) {
            Patient::create([
                'nombre_completo' => 'Andrea Perez',
                'fecha_nacimiento' => '2024-01-11',
                'telefono' => '8348889557',
                'genero' => 'Femenino',
            ]);
        }

        // Agregar productos
        Producto::create([
            'muestra' => 'images/protesis-antebrazo.png',
            'producto' => 'Prótesis de Antebrazo',
            'cantidad' => 10,
            'precio' => 500.00,
        ]);

        Producto::create([
            'muestra' => 'images/protesis-dientes.png',
            'producto' => 'Prótesis de Dientes',
            'cantidad' => 20,
            'precio' => 150.00,
        ]);

        Producto::create([
            'muestra' => 'images/protesis-pie.png',
            'producto' => 'Prótesis de Pie',
            'cantidad' => 5,
            'precio' => 300.00,
        ]);
    }
}
