<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Revision; 
use App\Models\Portafolio; 
use App\Models\CargaAcademica;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
class DocenteController extends Controller
{
    public function index()
    {
        return view('docente.dashboard'); // Asegúrate de tener esta vista creada
    }
    public function visualizarEstado()
{
    // Obtener el usuario logueado
    $usuarioLogueado = Auth::id();
    
    // Obtener los portafolios del usuario logueado
    $portafolios = Portafolio::where('id_usuario', $usuarioLogueado)->get();

    // Verificar si no se encuentran portafolios
    if ($portafolios->isEmpty()) {
        return view('docente.estado_portafolios', ['mensaje' => 'No se encontraron portafolios para este usuario.']);
    }

    // Recuperar las revisiones y el estado asociado a cada portafolio
    $datosPortafolios = [];

    foreach ($portafolios as $portafolio) {
        // Buscar la revisión asociada
        $revision = Revision::where('id_portafolio', $portafolio->id)->first();
        
        // Obtener el curso asociado al portafolio
        $cargaAcademica = CargaAcademica::find($portafolio->id_carga);
        $curso = null;
        if ($cargaAcademica) {
            $curso = Curso::where('id_curso', $cargaAcademica->id_curso)->first();
        }

        $datosPortafolios[] = [
            'id_portafolio' => $portafolio->id,
            'comentarios' => $revision ? $revision->comentarios : 'Sin comentarios',
            'estado_revision' => $revision ? $revision->resultado : 'Sin revisión',
            'nombre_curso' => $curso ? $curso->nombre : 'Curso no asignado',
        ];
    }

    // Pasar los datos a la vista
    return view('docente.estado_portafolios', compact('datosPortafolios'));
}

public function cambiarEstado($idPortafolio)
{
    // Buscar el portafolio
    $portafolio = Portafolio::find($idPortafolio);
    if (!$portafolio) {
        return redirect()->back()->with('error', 'Portafolio no encontrado');
    }

    // Buscar la revisión asociada
    $revision = Revision::where('id_portafolio', $portafolio->id)->first();
    if (!$revision) {
        return redirect()->back()->with('error', 'Revisión no encontrada');
    }

    // Cambiar el estado de la revisión a 'Corregir'
    $revision->resultado = 'Pendiente';
    $portafolio->estado = 'Pendiente';
    $revision->save();
    $portafolio->save();

    return redirect()->route('docente.dashboard')->with('success', 'Estado actualizado correctamente');
}


}
