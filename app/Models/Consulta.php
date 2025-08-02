<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'nombre_paciente',
        'motivo',
        'exploracion',
        'diagnostico',
        'tratamiento',
        'recetas',
    ];

    protected $casts = [
        'recetas' => 'array',
    ];
}
