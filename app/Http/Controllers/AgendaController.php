<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Patient;
use App\Models\Servicio;
use Carbon\Carbon;

class AgendaController extends Controller
{

    public function create()
    {
        $appointments = Agenda::with('patient')->get();
        $pacientes = Patient::all();
        $servicios = Servicio::all();


        $events = $appointments->map(function ($appointment) {
            $title = $appointment->patient ? $appointment->patient->nombre_completo : 'Nombre del paciente no disponible';
            return [
                'title' => $title,
                'start' => $appointment->fecha . 'T' . $appointment->hora,
            ];
        });

        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.calendario', compact('appointments', 'pacientes', 'events'));
        } elseif (auth()->user()->tipo === 'doctor') {
            return view('doctor.calendario', compact('appointments', 'pacientes', 'events'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente_agenda' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'telefono' => 'required',
        ]);
    
        Agenda::create([
            'id_paciente_agenda' => $request->id_paciente_agenda,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'telefono' => $request->telefono,
            'atendida' => false,
        ]);
    
        if (auth()->user()->tipo === 'secretaria') {
            return redirect()->route('secretaria.calendario');
        } elseif (auth()->user()->tipo === 'doctor') {
            return redirect()->route('calendario');
        }
    }
    

    public function atendida($id)
    {
        $appointment = Agenda::findOrFail($id);
        $appointment->atendida = 1;
        $appointment->save();

        return redirect()->route('dashboard')->with('success', 'Cita marcada como atendida.');
    }

    public function desatendida($id)
    {
        $appointment = Agenda::findOrFail($id);
        $appointment->atendida = 0;
        $appointment->save();

        return redirect()->route('dashboard')->with('success', 'Cita marcada como desatendida.');
    }

    public function index()
{
    // Marcar como atendidas las citas de fechas anteriores a la actual
    $today = Carbon::today();
    DB::table('agendas')
        ->where('fecha', '<', $today)
        ->update(['atendida' => true]);

    // Obtener las citas para hoy y el futuro
    $appointments = DB::table('agendas')
        ->where('fecha', '>=', $today)
        ->orderBy('fecha', 'asc')
        ->get();

    // Convertir citas a un formato compatible con FullCalendar
    $events = $appointments->map(function ($appointment) {
        return [
            'title' => $appointment->title,
            'start' => $appointment->fecha . 'T' . $appointment->hora,
            'extendedProps' => [
                'phone' => $appointment->telefono,
            ],
        ];
    });

    return view('agendas.index', compact('appointments', 'events'));
}
}

