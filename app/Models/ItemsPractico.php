<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsPractico extends Model
{
    use HasFactory;
    protected $table = 'items_practico';
    protected $fillable = ['id_portafolio','avance_academico',
                'evidencia_actividades',
                'registro_asistencia_1P',
                'registro_asistencia_2P',
                'registro_asistencia_3P',
                'registro_notas_1P',
                'registro_notas_2P',
                'registro_notas_3P'
    ];
}
