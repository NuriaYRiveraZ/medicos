<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Producto; // Importa el modelo Producto

class ConsultaController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all(); // Obtén todos los servicios

        // Obtener medicamentos filtrados por tipo
        $medicamentos = Producto::where('tipo', 'Medicamento')->get();

        // Obtener otros productos filtrados por tipo
        $otrosProductos = Producto::where('tipo', '!=', 'Medicamento')->get();

        return view('doctor.consultas', compact('servicios', 'medicamentos', 'otrosProductos'));
    }

    public function show($id)
{
    $consulta = Consulta::find($id); // Aquí debes reemplazar 'Consulta' con el modelo adecuado y añadir lógica según tu aplicación
    return view('consultas.show', compact('consulta'));
}

}
