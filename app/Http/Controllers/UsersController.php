<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $usuarios = User::all();
            return view('secretaria.usuarios', compact('usuarios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $usuarios = User::all();
            return view('doctor.usuarios', compact('usuarios'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tipo' => 'required|string|in:secretaria,doctor',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('users.create')->with('success', 'Usuario registrado exitosamente.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('users.create')->with('success', 'Usuario eliminado exitosamente.');
        }
        return redirect()->route('users.create')->with('error', 'Usuario no encontrado.');
    }
}
