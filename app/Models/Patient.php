<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'fecha_nacimiento',
        'genero',
        'telefono',
    ];

    protected $table = 'pacientes';
}
