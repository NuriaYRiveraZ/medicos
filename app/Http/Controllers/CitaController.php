<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Medicamento;
use App\Models\Servicio;

class CitaController extends Controller
{
    public function terminarConsulta(Request $request)
    {
        DB::transaction(function () use ($request) {

            $total = 0;
    
            $medicamentos = $request->input('medicamentos', []);
            foreach ($medicamentos as $medicamento) {
                $medicamentoData = Medicamento::find($medicamento['id']);
                if ($medicamentoData) {
                    $total += $medicamentoData->precio * $medicamento['cantidad'];
                }
            }

            $servicios = $request->input('servicios', []);
            foreach ($servicios as $servicio) {
                $servicioData = Servicio::find($servicio['id']);
                if ($servicioData) {
                    $total += $servicioData->precio * $servicio['cantidad'];
                }
            }

            $productos = $request->input('productos', []);
            foreach ($productos as $producto) {
                $productoData = Producto::find($producto['id']);
                if ($productoData) {
                    $total += $productoData->precio * $producto['cantidad'];
                }
            }
    
            // Crear nueva cita
            $cita = Cita::create([
                'id_paciente_citas' => $request->input('id_paciente_citas'),
                'fecha' => now(),
                'peso' => $request->input('peso'),
                'temperatura' => $request->input('temperatura'),
                'frecuencia_cardiaca' => $request->input('frecuencia_cardiaca'),
                'tension' => $request->input('tension'),
                'talla' => $request->input('talla'),
                'saturacion' => $request->input('saturacion'),
                'motivo_consulta' => $request->input('motivo_consulta'),
                'estado_pago' => 'no pagado',
                'total_pagar' => $total,
            ]);
    
            // Actualizar la agenda para marcarla como atendida
            $agenda = Agenda::where('id_paciente_agenda', $request->input('id_paciente_citas'))
                            ->whereDate('fecha', now()->format('Y-m-d'))
                            ->first();
    
            if ($agenda) {
                $agenda->atendida = 1;
                $agenda->save();
            }
        });
    
        return redirect()->route('dashboard');
    }    
}
