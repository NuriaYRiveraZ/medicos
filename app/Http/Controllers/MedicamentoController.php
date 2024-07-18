<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Medicamento;


class MedicamentoController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $medicamentos = Medicamento::where('tipo', 'Medicamento')->get();
            return view('secretaria.medicamentos', compact('medicamentos'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $medicamentos = Medicamento::where('tipo', 'Medicamento')->get();
            return view('doctor.medicamentos', compact('medicamentos'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:Medicamento',
            'cantidad' => 'required|integer',
            'precio' => 'required|string|max:255',
        ]);

        Medicamento::create([
            'nombre' => $request->nombre,
            'tipo' => 'Medicamento',
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
        ]);

        return redirect()->back()->with('success', 'Medicamento agregado con éxito.');
    }

    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);
        if ($medicamento) {
            $medicamento->delete();
            return redirect()->route('medicamentos.create')->with('success', 'Medicamento eliminado exitosamente.');
        }
        return redirect()->route('medicamentos.create')->with('error', 'Medicamento no encontrado.');
    }

    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);
    
        $medicamento->nombre = $request->nombre;
        $medicamento->tipo = 'Medicamento';
        $medicamento->cantidad = $request->cantidad;
        $medicamento->precio = $request->precio;
    
        $medicamento->save();
    
        return redirect()->back()->with('success', 'Medicamento actualizado correctamente.');
    }
}
