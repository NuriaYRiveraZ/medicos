<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $productos = [
            ['nombre' => 'Paracetamol', 'tipo' => 'Medicamento', 'precio' => 15.50, 'cantidad' => 100],
            ['nombre' => 'Ibuprofeno', 'tipo' => 'Medicamento', 'precio' => 20.75, 'cantidad' => 80],
            ['nombre' => 'Vitamina C', 'tipo' => 'Producto', 'precio' => 10.00, 'cantidad' => 50],
            ['nombre' => 'Jabón antibacterial', 'tipo' => 'Producto', 'precio' => 5.25, 'cantidad' => 120],
            ['nombre' => 'Aspirina', 'tipo' => 'Medicamento', 'precio' => 12.30, 'cantidad' => 150],
            ['nombre' => 'Crema hidratante', 'tipo' => 'Producto', 'precio' => 8.50, 'cantidad' => 90],
            ['nombre' => 'Antidiarreico', 'tipo' => 'Medicamento', 'precio' => 18.75, 'cantidad' => 70],
            ['nombre' => 'Acetaminofén', 'tipo' => 'Medicamento', 'precio' => 10.25, 'cantidad' => 110],
            ['nombre' => 'Desinfectante de manos', 'tipo' => 'Producto', 'precio' => 7.50, 'cantidad' => 80],
            ['nombre' => 'Antigripal', 'tipo' => 'Medicamento', 'precio' => 22.00, 'cantidad' => 60],
            ['nombre' => 'Shampoo anticaspa', 'tipo' => 'Producto', 'precio' => 9.80, 'cantidad' => 100],
            ['nombre' => 'Analgésico en gel', 'tipo' => 'Medicamento', 'precio' => 15.00, 'cantidad' => 85],
            ['nombre' => 'Pañuelos desechables', 'tipo' => 'Producto', 'precio' => 3.50, 'cantidad' => 200],
            ['nombre' => 'Pastillas para la garganta', 'tipo' => 'Medicamento', 'precio' => 14.20, 'cantidad' => 95],
            ['nombre' => 'Gel para quemaduras', 'tipo' => 'Producto', 'precio' => 6.75, 'cantidad' => 150],
            ['nombre' => 'Jarabe para la tos', 'tipo' => 'Medicamento', 'precio' => 18.50, 'cantidad' => 75],
            ['nombre' => 'Protector solar', 'tipo' => 'Producto', 'precio' => 12.80, 'cantidad' => 110],
            ['nombre' => 'Antihistamínico', 'tipo' => 'Medicamento', 'precio' => 17.90, 'cantidad' => 65],
            ['nombre' => 'Crema facial antiarrugas', 'tipo' => 'Producto', 'precio' => 21.50, 'cantidad' => 55],
        ];

        // Insertar los datos en la tabla 'productos'
        DB::table('productos')->insert($productos);
    }
}
