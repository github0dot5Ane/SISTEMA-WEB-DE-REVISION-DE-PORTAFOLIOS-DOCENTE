<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'revision';
    protected $fillable = [
        'id_portafolio', 'criterio', 'resultado', 
        'comentarios', 'fecha_revision', 
        'id_semestre', 'id_usuario_revisor'
    ];
    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisor_id');
    }
    // Relación con el modelo User
    public function revisorr()
    {
        return $this->belongsTo(User::class, 'id_usuario_revisor');
    }
    // Relación con el portafolio
    public function portafolio()
    {
        return $this->belongsTo(Portafolio::class, 'id_usuario_portafolio');
    }

    // Relación con la carga académica
    public function cargaAcademica()
    {
        return $this->hasOneThrough(CargaAcademica::class, Portafolio::class, 'id', 'id_carga');
    }
    
}
