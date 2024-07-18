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
            ['nombre' => 'Vitamina C', 'tipo' => 'Producto', 'precio' => 10.00, 'cantidad' => 50],
            ['nombre' => 'Jabón antibacterial', 'tipo' => 'Producto', 'precio' => 5.25, 'cantidad' => 120],
            ['nombre' => 'Crema hidratante', 'tipo' => 'Producto', 'precio' => 8.50, 'cantidad' => 90],
            ['nombre' => 'Desinfectante de manos', 'tipo' => 'Producto', 'precio' => 7.50, 'cantidad' => 80],
            ['nombre' => 'Shampoo anticaspa', 'tipo' => 'Producto', 'precio' => 9.80, 'cantidad' => 100],
            ['nombre' => 'Pañuelos desechables', 'tipo' => 'Producto', 'precio' => 3.50, 'cantidad' => 200],
            ['nombre' => 'Gel para quemaduras', 'tipo' => 'Producto', 'precio' => 6.75, 'cantidad' => 150],
            ['nombre' => 'Protector solar', 'tipo' => 'Producto', 'precio' => 12.80, 'cantidad' => 110],
            ['nombre' => 'Crema facial antiarrugas', 'tipo' => 'Producto', 'precio' => 21.50, 'cantidad' => 55],
        ];

        // Insertar los datos en la tabla 'productos'
        DB::table('productos')->insert($productos);
    }
}
