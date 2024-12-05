<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model
{
    use HasFactory;
    protected $table = 'portafolio';
    protected $fillable = [
        'id_usuario', 'id_carga', 'fecha_subida', 'estado', 
        'id_semestre', 'caratula', 'carga_lectiva', 
        'filosofia', 'cv', 'silabo', 'tipo_curso'
    ];
    // Relación con la tabla carga_academica
    public function cargaAcademica()
    {
        return $this->belongsTo(CargaAcademica::class, 'id_carga');
    }
}
