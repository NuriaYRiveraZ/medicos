<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Servicio;

use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('secretaria.pacientes', compact('pacientes','servicios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('doctor.pacientes', compact('pacientes','servicios'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'sex' => 'required|string|in:Masculino,Femenino',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear paciente
        $patient = Patient::create([
            'nombre_completo' => $request->name,
            'fecha_nacimiento' => $request->birthdate,
            'genero' => $request->sex,
            'telefono' => $request->phone,
        ]);

        // Crear usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => 'paciente',
        ]);

        return redirect()->route('patients.create')->with('success', 'Paciente registrado exitosamente.');
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->delete();
            return redirect()->route('patients.create')->with('success', 'Paciente eliminado exitosamente.');
        }
        return redirect()->route('patients.create')->with('error', 'Paciente no encontrado.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'birthdate' => 'required|date',
            'sex' => 'required|string|in:Masculino,Femenino',
            'phone' => 'required|string|max:15',
        ]);

        $patient = Patient::find($id);
        if ($patient) {
            $patient->fecha_nacimiento = $request->birthdate;
            $patient->genero = $request->sex;
            $patient->telefono = $request->phone;
            $patient->save();

            return redirect()->route('patients.create')->with('success', 'Paciente actualizado exitosamente.');
        }

        return redirect()->route('patients.create')->with('error', 'Paciente no encontrado.');
    }
}

