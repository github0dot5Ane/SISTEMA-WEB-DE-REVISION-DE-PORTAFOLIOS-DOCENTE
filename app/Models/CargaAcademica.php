<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaAcademica extends Model
{
    use HasFactory;
    protected $table = 'carga_academica';
    protected $fillable = ['id_curso', 'id_usuario', 'nro_creditos', 'es_teorico', 'id_malla', 'id_semestre'];
    public $timestamps = false;
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
