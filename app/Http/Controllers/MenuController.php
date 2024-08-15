<?php
namespace App\Http\Controllers;
use App\Models\Agenda;
use App\Models\Servicio;
use App\Models\Patient;
use App\Models\User;
use App\Models\Producto;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $agendas = Agenda::all();
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('secretaria.pacientes', compact('agendas', 'pacientes'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $agendas = Agenda::all();
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('doctor.dashboard', compact('agendas', 'pacientes'));
        } elseif (auth()->user()->tipo === 'paciente') {
            $agendas = Agenda::all();
            $pacientes = Patient::all();
            return view('paciente.dashboard', compact('agendas', 'pacientes'));
        }
    }

    public function pacientes()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('secretaria.pacientes', compact('pacientes'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('doctor.pacientes', compact('pacientes'));
        }
    }

    public function productos()
    {
        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.productos');
        } elseif (auth()->user()->tipo === 'doctor') {
            $productos = Producto::all();
            return view('doctor.productos', compact('productos'));
        }
    }

    public function usuarios()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $usuarios = User::all();
            return view('secretaria.usuarios', compact('usuarios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            return view('doctor.usuarios');
        }
    }

    public function consultas()
    {
        $servicios = Servicio::all(); 
        $medicamentos = Producto::all(); 
        return view('doctor.consulta', compact('servicios', 'medicamentos'));
    }
    

    public function servicios()
    {
        $servicios = Servicio::all();
        return view('doctor.servicios', compact('servicios'));
    }

    public function calendario()
    {
        $events = [];
        $appointments = [];
        $pacientes = Patient::all();
        $today = Carbon::today();
    
        // Marcar como atendidas las citas de fechas anteriores a la actual
        Agenda::where('fecha', '<', $today)
              ->where('atendida', 0)
              ->update(['atendida' => 1]);
    
        // Obtener las citas que no han sido atendidas
        $agendas = Agenda::with(['patient'])->where('atendida', 0)->get();
    
        if (auth()->user()->tipo === 'paciente') {
            foreach ($agendas as $agenda) {
                $events[] = [
                    'title' => 'Ocupado',
                    'start' => $agenda->fecha . 'T' . $agenda->hora,
                    'end' => $agenda->fecha . 'T' . date('H:i:s', strtotime($agenda->hora) + 3600),
                ];
    
                $appointments[] = [
                    'title' => 'Ocupado',
                    'date' => $agenda->fecha,
                    'time' => $agenda->hora,
                    'phone' => $agenda->patient->telefono 
                ];
            }
            return view('paciente.calendario', compact('events', 'appointments', 'pacientes'));
        } else {
            foreach ($agendas as $agenda) {
                $events[] = [
                    'title' => $agenda->patient->nombre_completo,
                    'start' => $agenda->fecha . 'T' . $agenda->hora,
                    'end' => $agenda->fecha . 'T' . date('H:i:s', strtotime($agenda->hora) + 3600),
                ];
    
                $appointments[] = [
                    'title' => $agenda->patient->nombre_completo,
                    'date' => $agenda->fecha,
                    'time' => $agenda->hora,
                    'phone' => $agenda->patient->telefono 
                ];
            }
    
            return view('doctor.calendario', compact('events', 'appointments', 'pacientes'));
        }
    }

    public function medicamentos()
    {
        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.medicamentos');
        } elseif (auth()->user()->tipo === 'doctor') {
            $medicamentos = Medicamento::all();
            return view('doctor.medicamentos', compact('medicamentos'));
        }
    }

    public function consulta($id)
    {
        $paciente = Patient::find($id);
        $servicios = Servicio::all(); 
        $medicamentos = Medicamento::all(); 
        $productos = Producto::all();
        return view('doctor.consulta', compact('paciente', 'servicios', 'medicamentos', 'productos'));
    }
    
    public function pagos()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $pacientes = \DB::table('citas')
                            ->join('pacientes', 'citas.id_paciente_citas', '=', 'pacientes.id')
                            ->where('citas.estado_pago', 'no pagado')
                            ->select('pacientes.id', 'pacientes.nombre_completo', 'citas.total_pagar')
                            ->get();
    
            return view('secretaria.pagos', compact('pacientes'));
        }
    }
    
    public function completarPago($id)
    {
        $cita = \DB::table('citas')->where('id_paciente_citas', $id)->first();
    
        if ($cita) {
            \DB::table('citas')->where('id_paciente_citas', $id)->update(['estado_pago' => 'pagado']);
            return redirect()->back()->with('success', 'Pago completado exitosamente.');
        }
    
        return redirect()->back()->with('error', 'Error al completar el pago.');
    }


}
