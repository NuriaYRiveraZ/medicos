<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Producto; 
use App\Models\Medicamento; 
use App\Models\Patient; 

class ConsultaController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all(); 
        $productos = Producto::all();
        $medicamentos = Medicamento::where('Medicamento')->get();


        return view('doctor.consultas', compact('servicios', 'medicamentos','productos'));
    }
}
