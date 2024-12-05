<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsTeorico extends Model
{
    use HasFactory;
    protected $table = 'items_teorico';
    protected $fillable = ['id_portafolio',
                'avance_academico',
                'registro_entrega_silabo',
                'informe_examen_entrada',
                'enunciado_y_solucion_exameN_1P',
                'enunciado_y_solucion_exameN_2P',
                'enunciado_y_solucion_exameN_3P',
                'evidencia_actividades',
                'registro_asistencia_1P',
                'registro_asistencia_2P',
                'registro_asistencia_3P',
                'registro_notas_1P',
                'registro_notas_2P',
                'registro_notas_3P',
                'cierre_portafolio'
    ];
}
