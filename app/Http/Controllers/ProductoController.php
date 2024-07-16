<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $productos = Producto::all();
            return view('secretaria.productos', compact('productos'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $productos = Producto::all();
            return view('doctor.productos', compact('productos'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:Producto,Medicamento',
            'cantidad' => 'required|integer',
            'precio' => 'required|string|max:255',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
        ]);

        return redirect()->back()->with('success', 'Producto agregado con éxito.');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
            return redirect()->route('productos.create')->with('success', 'Producto eliminado exitosamente.');
        }
        return redirect()->route('productos.create')->with('error', 'Producto no encontrado.');
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        $producto->nombre = $request->nombre;
        $producto->tipo = $request->tipo;
        $producto->cantidad = $request->cantidad;
        $producto->precio = $request->precio;
    
        $producto->save();
    
        return redirect()->back()->with('success', 'Producto actualizado correctamente.');
    }

}
