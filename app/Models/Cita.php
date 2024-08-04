<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paciente_citas',
        'fecha',
        'peso',
        'temperatura',
        'frecuencia_cardiaca',
        'tension',
        'talla',
        'total_pagar',
        'saturacion',
        'motivo_consulta',
        'estado_pago',
    ];
}
